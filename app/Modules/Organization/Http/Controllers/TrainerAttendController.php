<?php

namespace Organization\Http\Controllers;
use Illuminate\Http\Request;

use Organization\Actions\TrainerAttend\{
    FilterAction,
};
use Organization\Http\Requests\TrainerAttend\{
    FilterDateRequest,
};
use Organization\Exports\TrainerAttend\{
    ExportData,
};
use Maatwebsite\Excel\Facades\Excel;
use Organization\Models\Training;


class TrainerAttendController extends JsonResponse
{
    public function index()
    {
        if (checkAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Report-View-TrainerAttend')
        ){
            return view('Organization::trainerAttends.index');

        }else
            return abort(401);
    }

    public function show($id)
    {
         $records           = Training::where('freelance_trainer_id',$id)->get();

        return view('Organization::trainerAttends.show', compact('records'));
    }

    public function Totaltrainings($id)
    {
        $trainingCounts    = Training::where('freelance_trainer_id',$id)->count();

        return view('Organization::trainerAttends.showCount', compact('trainingCounts'));
    }
    public function data(Request $request, FilterAction $filterAction)
    {
        $records = $filterAction->execute($request)
            ->orderBy('id','DESC')
            ->paginate(10)->appends([
                'view'       => $request->input('view'),
                'column'     => $request->input('column'),
                'value'      => $request->input('value'),
                'start_date' => $request->input('start_date'),
                'end_date'   => $request->input('end_date'),
                'day'     => $request->input('day'),
            ]);
        $result = view('Organization::trainerAttends.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }

    public function export(FilterDateRequest $request, FilterAction $filterAction)
    {
        try{
            $records = $filterAction->execute($request)->orderBy('id','DESC')->get();
            return Excel::download(new ExportData($records), 'organization_trainer_attend_data.csv');
        }
        catch (\Exception $ex){
            return redirect()->back()->with('error', 'Error occurred, Please try again later.');
        }
    }

}
