<?php

namespace Organization\Http\Controllers;

use App\Http\Controllers\Controller;
use Organization\Models\Subscription;
use Organization\Models\Training;


class TrainingDashboardController extends Controller
{
    public function viewTraining($id)
    {

         $record                = Training::where('id',$id)->get();
        $no_subscribers         = Subscription::where('training_id',$id)->count('subscriber_id');

        return view('Organization::viewTraining', compact('record','no_subscribers'));
    }

    public function AllTrainings()
    {

         $records                = Training::get();

        return view('Organization::allTrainings', compact('records'));
    }

}
