<?php

namespace Admin\Http\Controllers;
use Admin\Models\Organization;
use User\Models\{
    User,
};


class SportActivityDashboardController extends JsonResponse
{
    public function __invoke()
    {
        $organization_ids = Organization::pluck('id');

        $playings = 0;
        $sports =0;
        $trainers = 0;
        $tranings =0;
        $subscribers = 0;
        $subs =0;
        $exp_mony=0;
        $all_mony =0;
        $resceved_mony=0;


        foreach ($organization_ids as $organization_id) {
            $db = DBConnection($organization_id);
            $playings += $db->table('sport_activity_areas')->count();
            $sports += $db->table('club_sports')->count();
            $trainers += $db->table('freelance_trainers')->count();
            $tranings += $db->table('trainings')->count();
            $subscribers += $db->table('subscriptions')->distinct()->pluck('subscriber_id')->count();
            $subs += $db->table('subscriptions')->count();
            $exp_mony += $db->table('subscriptions')->sum('payment_balance');
            $all_mony += $db->table('subscriptions')->sum('price');
            $resceved_mony += $db->table('subscriptions')->sum('rest_of_paid');
        }

        ElwezaraDBConnection();

        $stats = [
            'playings'=>$playings,
            'sports'=>$sports,
            'trainers'=>$trainers,
            'tranings'=>$tranings,
            'subscribers'=>$subscribers,
            'subs'=>$subs,
            'exp_mony'=>$exp_mony,
            'all_mony'=>$all_mony,
            'resceved_mony'=>$resceved_mony,

        ];
        return view('Admin::sports-activities',compact('stats'));
    }
}
