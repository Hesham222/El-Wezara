<?php

namespace Organization\Http\Controllers;
use Organization\Actions\HotelReservation\PaymentFilterAction;
use Organization\Actions\PointOfSaleOrder\POSPaymentsAction;
use Organization\Actions\RentContractPayment\PaidFilterAction;
use Organization\Actions\LaundryOrder\LaundryPaymentsAction;
use Organization\Actions\Reservation\PaymentsFilterAction;
use Organization\Actions\Payment\{

    FilterAction,

};
use Organization\Http\Requests\Payment\{

    FilterDateRequest
};
use Organization\Exports\Payment\{
    ExportData,
};
use Organization\Models\{
    Payment
};


use Organization\Models\RentContractPayment;
use Organization\Models\HotelReservationPayment;
use Organization\Models\GateShiftSheet;
use Organization\Models\ReservationPayment;
use Organization\Models\LaundryOrderPayment;
use Organization\Models\OrderPayment;


class ReportsController extends JsonResponse
{
    public function sportsActivitiesIndex()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialDepartmentBills-View-Report-SportActivity')
        ){
            return view('Organization::f_reports.sportsActivities.sportsActivitiesIndex');
        }else
            return abort(401);
    }


    public function sportsActivitiesIndexData(FilterDateRequest $request, FilterAction $filterAction)
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
        $result = view('Organization::f_reports.sportsActivities.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function sportsActivitiesApprove($id)
    {


        $sportAct = Payment::FindOrFail($id);
        $sportAct->approved = 1 ;
        $sportAct->save();
        return back()->with('success','تم قبول الفاتورة');

    }



    public function rentBills()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialDepartmentBills-View-Report-RentBill')
        ){
            return view('Organization::f_reports.rentBills.index');
        }else
            return abort(401);
    }


    public function rentBillsData(FilterDateRequest $request, PaidFilterAction $filterAction)
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
        $result = view('Organization::f_reports.rentBills.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function rentBillsApprove($id)
    {


        $sportAct = RentContractPayment::FindOrFail($id);
        $sportAct->approved = 1 ;
        $sportAct->save();
        return back()->with('success','تم قبول الفاتورة');

    }

    public function hotelReservations()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialDepartmentBills-View-Report-HotelReservation')
        ){
            return view('Organization::f_reports.hotelReservations.index');
        }else
            return abort(401);
    }


    public function hotelReservationsData(FilterDateRequest $request, PaymentFilterAction $filterAction)
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
        $result = view('Organization::f_reports.hotelReservations.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function hotelReservationApprove($id)
    {


        $sportAct = HotelReservationPayment::FindOrFail($id);
        $sportAct->approved = 1 ;
        $sportAct->save();
        return back()->with('success','تم قبول الفاتورة');

    }


    public function gateTickets()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialDepartmentBills-View-Report-GateTicket')
        ){
            return view('Organization::f_reports.gateTickets.index');
        }else
            return abort(401);
    }


    public function gateTicketsData(FilterDateRequest $request, \Organization\Actions\GateShiftSheet\FilterAction $filterAction)
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
        $result = view('Organization::f_reports.gateTickets.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function gateTicketsReservationApprove($id)
    {


        $sportAct = GateShiftSheet::FindOrFail($id);
        $sportAct->approved = 1 ;
        $sportAct->save();
        return back()->with('success','تم قبول الفاتورة');

    }


    public function eventBills()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialDepartmentBills-View-Report-EventBills')
        ){
            return view('Organization::f_reports.eventBills.index');
        }else
            return abort(401);
    }

    public function eventBillsData(FilterDateRequest $request, PaymentsFilterAction $filterAction)
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
        $result = view('Organization::f_reports.eventBills.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function eventBillsApprove($id)
    {


        $sportAct = ReservationPayment::FindOrFail($id);
        $sportAct->approved = 1 ;
        $sportAct->save();
        return back()->with('success','تم قبول الفاتورة');

    }

    public function laundryBills()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialDepartmentBills-View-Report-LaundryBills')
        ){
            return view('Organization::f_reports.laundryBills.index');
        }else
            return abort(401);
    }

    public function laundryBillsData(FilterDateRequest $request, LaundryPaymentsAction $filterAction)
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
        $result = view('Organization::f_reports.laundryBills.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function laundryBillsApprove($id)
    {


        $sportAct = LaundryOrderPayment::FindOrFail($id);
        $sportAct->approved = 1 ;
        $sportAct->save();
        return back()->with('success','تم قبول الفاتورة');

    }

    public function posBills()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialDepartmentBills-View-Report-PosBills')
        ){
            return view('Organization::f_reports.posBills.index');
        }else
            return abort(401);
    }

    public function posBillsData(FilterDateRequest $request, POSPaymentsAction $filterAction)
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
        $result = view('Organization::f_reports.posBills.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


    public function posBillsApprove($id)
    {


        $sportAct = OrderPayment::FindOrFail($id);
        $sportAct->approved = 1 ;
        $sportAct->save();
        return back()->with('success','تم قبول الفاتورة');

    }

}
