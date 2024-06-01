<?php

namespace Organization\Http\Controllers;
use App\Services\FirebaseService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\Ticket\{
    StoreAction,
    UpdateAction,
    TrashAction,
    RestoreAction,
    DestroyAction,
    FilterAction,
    StartShiftAction,
    EndShiftAction
};
use Organization\Http\Requests\Ticket\{
    StoreRequest,
    UpdateRequest,
    RemoveRequest,
    FilterDateRequest,
    StartShiftRequest,
    EndShiftRequest
};
use Organization\Exports\Ticket\{
    ExportData,
};
use Organization\Http\Resources\TicketPriceResource;
use Organization\Models\Gate;
use Organization\Models\GateShiftSheet;
use Organization\Models\Reservation;
use Organization\Models\{GateShift, Ticket};
use Organization\Models\TicketCategory;
use Organization\Models\TicketPrice;
use Organization\Models\WeekDay;

class TicketController extends JsonResponse
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function index()
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ticket-Add'))
            return view('Organization::tickets.index');
        else
            return abort(401);
    }

    public function getSubCategoryPrices(Request $request)
    {
        $prices = TicketPrice::where('ticket_category_id',$request->input('category_id'))->get();
        $results = TicketPriceResource::collection($prices);
        return response()->json($results);
    }

    public function create()
    {
        $startShift = null;




        if (!checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Gate-Module'))
        {

            return redirect()->back()->with('error','لم يتم تحديد بوابة لك الاشراف اليوم')->withInput();
            /*$startShift = "gate";
            $categories = TicketCategory::all();
            $gates = Gate::all();
            return view('Organization::tickets.create', compact('categories','gates','startShift'));*/
        }
        elseif (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ticket-Add'))
        {


            $startShift = GateShiftSheet::where([ ['organization_admin_id',auth('organization_admin')->user()->id],['shift_date',Carbon::now()->format('Y-m-d')] ])->first();

            if ($startShift && !is_null($startShift->shift_end))
                return redirect()->back()->with('error','لقد أغلقت الشيفت الخاص بك')->withInput();



            $dayId = WeekDay::select('id')->where('name',ConvertToArabicDay(Carbon::today()->format('l')))->pluck('id')->first();

            $gate = Gate::whereHas('gateShifts',function( $query ) use ($dayId) {
                $query->where('week_day_id',$dayId);
            })->whereHas('gateShifts.gateShiftAdmins',function( $query ) {
                $query->where('organization_admin_id',auth('organization_admin')->user()->id);
            })->first();
            if (is_null($gate))
                return redirect()->back()->with('error','لم يتم تحديد بوابة لك الاشراف اليوم')->withInput();
            //$categories = TicketCategory::all();
            $ticketPrices = TicketPrice::all();
            $reservationTickets = Reservation::where([ ['booking_date',date('Y-m-d')],['number_of_tickets','>',0] ])->get();
            //$gates = Gate::all();
            return view('Organization::tickets.create',compact('ticketPrices','gate','startShift','reservationTickets'));
        }
        else
            return abort(401);
    }

    public function store(StoreRequest $request, StoreAction $storeAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ticket-Add') ||
            checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Gate-Module'))
        {
            DB::beginTransaction();
            try {
            $ticket =     $storeAction->execute($request);
                DB::commit();
                $this->firebaseService->refreshCS();


               // return redirect()->route('organizations.ticket.create',['ticket_id'=>$ticket->id])->with('success','Data has been saved successfully.');
             return redirect()->route('organizations.ticket.print_ticket',$ticket->id)->with('success','Data has been saved successfully.');
            } catch (\Exception $exception) {
                DB::rollback();
                return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
            }
        }
        else
            return abort(401);
    }

    public function print_ticket($id)
    {
$ticket = Ticket::FindOrFail($id);

return view('Organization::tickets.print_ticket',compact('ticket'));


    }

    public function edit($id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Gate-Module'))
        {
            $record = Ticket::findOrFail($id);
            $categories = TicketCategory::all();
            $gates = Gate::all();
            return view('Organization::tickets.edit', compact('record','categories','gates'));
        }
        else
            return abort(401);
    }

    public function update(UpdateRequest $request, UpdateAction $updateAction, $id)
    {
        DB::beginTransaction();
        try {
            $updateAction->execute($request, $id);
            DB::commit();
            return redirect()->route('organizations.ticket.index')->with('success','Data has been saved successfully.');
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->back()->with('error','Failed, Please try again later.')->withInput();
        }
    }


    public function data(FilterDateRequest $request, FilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),

            ]);
        $result = view('Organization::tickets.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_tickets_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

    public function trash(RemoveRequest $request, TrashAction $trashAction)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Gate-Module'))
        {
            DB::beginTransaction();
            try {
                $record =  $trashAction->execute($request);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data moved to trash successfully.', 200, [], $record, ['module' => 'tickets', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }
        else
            return abort(401);
    }

    public function destroy(RemoveRequest $request, DestroyAction $destroyAction, $id)
    {
        if (checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Gate-Module'))
        {
            DB::beginTransaction();
            try {
                if ($id === 1)
                    return $this->response(500, 'Failed, You can not delete this record.', 200);
                $record =  $destroyAction->execute($request, $id);
                if(!$record)
                    return $this->response(500, 'Failed, This record is not found .', 200);
                DB::commit();
                return $this->response(200, 'Data has been deleted successfully.', 200, [], $record, ['module' => 'tickets', 'trashesCount' => $this->countTrashes()]);
            } catch (\Exception $ex) {
                DB::rollBack();
                return $this->response(500, 'Failed, Please try again later.', 200);
            }
        }
        else
            return abort(401);
    }

    public function restore(RemoveRequest $request, RestoreAction $restoreAction)
    {
        DB::beginTransaction();
        try {
            $record =  $restoreAction->execute($request);
            DB::commit();
            return $this->response(200, 'Data has been restored successfully.', 200, [], $record, ['module' => 'tickets', 'trashesCount' => $this->countTrashes()]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function startShift(StartShiftRequest $request, StartShiftAction $startShiftAction)
    {
        DB::beginTransaction();
        try {
            $startShiftAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.ticket.create');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    public function endShift(EndShiftRequest $request, EndShiftAction $endShiftAction)
    {
        DB::beginTransaction();
        try {
            $endShiftAction->execute($request);
            DB::commit();
            return redirect()->route('organizations.ticket.index');
        } catch (\Exception $ex) {
            DB::rollBack();
            return $this->response(500, 'Failed, Please try again later.', 200);
        }
    }

    private function countTrashes()
    {
        return Ticket::onlyTrashed()->count();
    }
}
