<?php

namespace Organization\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use Organization\Actions\prepAreaNotification\{
    PrepAreaNotificationAction
};
use Organization\Http\Requests\SpenPermission\{
    FilterDateRequest
};

use App\Http\Traits\FileTrait;
use Organization\Models\Notification;
use Organization\Models\PreparationArea;

class PrepAreaNotificationController extends JsonResponse
{
    use FileTrait;

    public function index($id)
    {
        $area = PreparationArea::FindOrFail($id);
        $area_notifications = Notification::where('model_type','PreparationArea')->where('model_id',$id)->get();

        foreach($area_notifications as $area_notification){
            $area_notification->seen = 1 ;
            $area_notification->save();

        }
        return view('Organization::prepAreaNotification.index',compact('area'));
    }

    public function data(FilterDateRequest $request, PrepAreaNotificationAction $filterAction)
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
        $result = view('Organization::prepAreaNotification.components.table_body',compact('records'))->render();
        return response()->json(['result' => $result, 'links' => $records->links()->render()], 200);
    }


}