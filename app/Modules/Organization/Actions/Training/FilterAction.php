<?php
namespace Organization\Actions\Training;
use Illuminate\Http\Request;
use Organization\Models\ClubSport;
use Carbon\Carbon;
use Organization\Models\Training;

class FilterAction
{
    public function execute(Request $request)
    {
        return Training::when($request->input('view') == 'trash', function ($query) use ($request) {
            return $query->onlyTrashed();
        })->with(['deletedBy' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])->with(['ClubSport' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->with(['ActivityArea' => function ($query) use ($request) {
            $query->select(['id','name']);

        }])->with(['FreelanceTrainer' => function ($query) use ($request) {
            $query->select(['id','name']);
        }])
        ->select(['id','name','club_sport_id','activity_area_id','freelance_trainer_id','type','deleted_by','deleted_at', 'created_at'])
        ->when($request->input('start_date') && $request->input('end_date'), function ($query) use ($request) {
            return $query->whereBetween('created_at',[Carbon::parse($request->input('start_date')), Carbon::parse($request->input('end_date'))]);
        })
        //sub query used in search field
        ->when($request->input('column') && $request->input('value'), function ($query) use ($request){
            return $query->when($request->input('column') == 'deletedBy' , function ($query) use ($request){
                    return $query->whereHas('deletedBy', function ($query) use ($request) {
                        $query->where('name', 'like', '%' . $request->input('value') . '%');
                    });
                })
                ->when($request->input('column') == '_id', function ($query) use ($request){
                    return $query->where('id',  $request->input('value') );
                })
                ->when($request->input('column') == 'name', function ($query) use ($request){
                    return $query->where('name', 'like', '%' . $request->input('value') . '%');
                });
                 })->when($request->input('clubSport'), function ($query) use ($request){
                        return $query->where('club_sport_id',  $request->input('clubSport') );
                })->when($request->input('area'), function ($query) use ($request){
                    return $query->where('activity_area_id',  $request->input('area') );

                })->when($request->input('trainer'), function ($query) use ($request){
                    return $query->where('freelance_trainer_id',  $request->input('trainer') );

                })->when($request->input('type'), function ($query) use ($request){
                    return $query->where('type',  $request->input('type') );

                });

    }
}
