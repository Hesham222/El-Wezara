<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\HotelWork\{
    ArrivalListAction,ReservationArrivalListAction,
    FoundLossAction,
    MiantinaceReportAction,
    DeoartuleListAction,
    CancelledListAction
};
use Organization\Exports\HotelWork\{
    HotelWorkWeeklyExportData,
    ArrivalListExportData,
    ReservationArrivalListExportData,
    FoundLossExportData,
    MiantinaceReportData,
    DeparturelListExportData,
    CancelledListExportData

};

use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;
use Organization\Models\Notification;
use Organization\Models\PreparationArea;
use Organization\Models\VacationRequest;

use Organization\Models\FinancialAdvanceRequest;



use Organization\Http\Requests\Hotel\{

    FilterDateRequest
};


use DateTime;
use DateInterval;
use DatePeriod;
use Organization\Models\Hotel;

class HotelWorkController extends JsonResponse
{
    use FileTrait;

    public function weekly(Request $request)
    {


        if($request->has('date')){
            $date = $request->date; // date
            $weekOfdays = array();
            $begin = new DateTime($date);
            $end = new DateTime($date);
            $end = $end->add(new DateInterval('P7D'));
            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval ,$end);

            foreach($daterange as $dt){
                $weekOfdays[] = $dt->format('Y-m-d');
            }

        }else{
            $date = date('Y-m-d'); // date
            $weekOfdays = array();
            $begin = new DateTime($date);
            $end = new DateTime($date);
            $end = $end->add(new DateInterval('P7D'));
            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval ,$end);

            foreach($daterange as $dt){
                $weekOfdays[] = $dt->format('Y-m-d');
            }

        }



        return view('Organization::hotelWork.weekly',compact('weekOfdays'
  ));
    }





    public function export(Request $request)
    {


        try{
            if($request->date == 0){
                $date = date('Y-m-d');

                $weekOfdays = array();
            $begin = new DateTime($date);
            $end = new DateTime($date);
            $end = $end->add(new DateInterval('P7D'));
            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval ,$end);

            foreach($daterange as $dt){
                $weekOfdays[] = $dt->format('Y-m-d');
            }
            return Excel::download(new HotelWorkWeeklyExportData($weekOfdays), 'HotelWorksWeekly_report_data.csv');


            }else {
                $date = $request->date;
                $weekOfdays = array();
                $begin = new DateTime($date);
                $end = new DateTime($date);
                $end = $end->add(new DateInterval('P7D'));
                $interval = new DateInterval('P1D');
                $daterange = new DatePeriod($begin, $interval ,$end);

                foreach($daterange as $dt){
                    $weekOfdays[] = $dt->format('Y-m-d');
                }
                return Excel::download(new HotelWorkWeeklyExportData($weekOfdays), 'HotelWorksWeekly_report_data.csv');

            }
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }





    public function arrivalList()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Hotel-View')
        ){
            return view('Organization::arrivalList.index');

        }else
            return abort(401);
    }




  public function arrivalListData(FilterDateRequest $request, ArrivalListAction $filterAction)
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
        $result = view('Organization::arrivalList.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }




    public function arrivalLisExport(FilterDateRequest $request, ArrivalListAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ArrivalListExportData($records), 'arrival_list_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

















    public function cancelledList()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Hotel-View')
        ){
            return view('Organization::cancelledList.index');

        }else
            return abort(401);
    }




  public function cancelledListData(FilterDateRequest $request, CancelledListAction $filterAction)
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
        $result = view('Organization::cancelledList.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }




    public function cancelledListExport(FilterDateRequest $request, CancelledListAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new CancelledListExportData($records), 'canceleed_list_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }












    public function departureList()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Hotel-View')
        ){
            return view('Organization::departureList.index');

        }else
            return abort(401);
    }




  public function departureListData(FilterDateRequest $request, DeoartuleListAction $filterAction)
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
        $result = view('Organization::departureList.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }




    public function departureListExport(FilterDateRequest $request, DeoartuleListAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new DeparturelListExportData($records), 'departutel_list_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }










    public function reservationArrivalList()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Hotel-View')
        ){
            return view('Organization::reservationArrivalList.index');

        }else
            return abort(401);
    }




  public function reservationArrivalListtData(FilterDateRequest $request, ReservationArrivalListAction $filterAction)
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
        $result = view('Organization::reservationArrivalList.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }




    public function reservationArrivalListExport(FilterDateRequest $request, ReservationArrivalListAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ReservationArrivalListExportData($records), 'resrvations_arrival_list_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }








    public function foundLoss()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Hotel-View')
        ){
            return view('Organization::foundLoss.index');

        }else
            return abort(401);
    }




  public function foundLosstData(FilterDateRequest $request, FoundLossAction $filterAction)
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
        $result = view('Organization::foundLoss.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }




    public function foundLossExport(FilterDateRequest $request, FoundLossAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new FoundLossExportData($records), 'found_loss_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }







    public function miantinaceReport()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Hotel-View')
        ){
            return view('Organization::miantinaceReport.index');

        }else
            return abort(401);
    }




  public function miantinaceReportData(FilterDateRequest $request, MiantinaceReportAction $filterAction)
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
        $result = view('Organization::miantinaceReport.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }




    public function miantinaceReportExport(FilterDateRequest $request, MiantinaceReportAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new  MiantinaceReportData($records), 'miantinace_report_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }








    public function OccupancyRateReport(Request $request)
    {


        if($request->has('year')){
            $date = DateTime::createFromFormat("Y-m-d", $request->year);


               $year = $date->format('Y');



if($request->input('hotel_id') == 0){
    $hotel_id = 0;
}else{
    $hotel_id = $request->input('hotel_id');
}
        }else{
            $year = date('Y'); // date
            $hotel_id = 0;


        }


      $hotels = Hotel::all();
        return view('Organization::hotelWork.OccupancyRateReport',compact('year','hotels' ,'hotel_id'
  ));
    }


    public function OccupancyAnnualReport(Request $request)
    {


        if($request->has('year')){
            $date = DateTime::createFromFormat("Y-m-d", $request->year);


            $year = $date->format('Y');



            if($request->input('hotel_id') == 0){
                $hotel_id = 0;
            }else{
                $hotel_id = $request->input('hotel_id');
            }
        }else{
            $year = date('Y'); // date
            $hotel_id = 0;


        }

        $hotels = Hotel::all();
        return view('Organization::hotelWork.OccupancyAnnualReport',compact('year','hotels' ,'hotel_id'
        ));
    }
}
