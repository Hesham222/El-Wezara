<?php

namespace Organization\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
use Organization\Models\ClubSport;
use Organization\Models\Payment;
use Organization\Models\Schedule;
use Organization\Models\Subscription;
use Organization\Models\Training;

class OrganizationController extends Controller
{
    public function home()
    {
        $subscriptionsToday = Subscription::whereDate('created_at', Carbon::today())->count();
        $paymentsToday      = Payment::whereDate('created_at', Carbon::today())->count();

        $date               = Carbon::today();
        $d                  = new DateTime($date);
        $today_date         = $d->format('l');
        $trainingsToday     = Schedule::where('day', $today_date)->count();


        //start graph
        $first_day = Carbon::now()->subDays(6);
        $i=0;
        $days=[];
        $subscriptions = [];
        $revenues = [];
        while($i < 7){

            array_push($subscriptions, Subscription::whereDate('created_at','=',$first_day)->count());

            array_push($days, $first_day->format('l'));

            array_push($revenues,(Payment::whereDate('created_at','=',$first_day)->sum('payment_amount')));
            $first_day->addDay();
            $i++;
        }
        //return $revenues;
        //end graph
        $clubSports = ClubSport::withCount('freelanceTrainings')->get();

        $remainingAmount = Subscription::sum('payment_balance');

        $date = Carbon::now();

        $activeSubscribers      = Subscription::whereDate('end_date', '>',$date)->orWhere('session_balance','!=','0')->count();

        $endingSubscriptions    = Subscription::whereMonth('end_date',Carbon::today()->month)->count();

        $getTrainings           = Training::withCount('Subscriptions')->limit(3)->get();


        $statistics = array(
            'subscriptions'         => $subscriptionsToday,
            'payments'              => $paymentsToday,
            'trainings'             => $trainingsToday,
            'days'                  => $days,
            'subscriptionsGraph'    => $subscriptions,
            'revenues'              => $revenues,
            'clubSports'            => $clubSports,
            'remainingAmount'       => $remainingAmount,
            'activeSubscribers'     => $activeSubscribers,
            'endingSubscriptions'   => $endingSubscriptions,
            'getTrainings'          => $getTrainings,
        );

        return view('Organization::home',compact('statistics'));
    }



    public function inventory()
    {
        return view('Organization::inventory.index');
    }


}
