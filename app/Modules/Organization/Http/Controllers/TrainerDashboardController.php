<?php

namespace Organization\Http\Controllers;

use App\Http\Controllers\Controller;
use Organization\Models\FreelanceTrainer;


class TrainerDashboardController extends Controller
{
    public function viewTrainers($id)
    {

        $records    = FreelanceTrainer::where('club_sport_id',$id)->get();

        return view('Organization::viewTrainers', compact('records'));
    }


}
