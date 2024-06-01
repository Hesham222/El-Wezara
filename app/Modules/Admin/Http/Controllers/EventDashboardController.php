<?php

namespace Admin\Http\Controllers;
use Admin\Models\Organization;
use Carbon\Carbon;
use User\Models\{
    User,
};


class EventDashboardController extends JsonResponse
{
    public function __invoke()
    {

        $organization_ids = Organization::pluck('id');

        $halls = 0;
        $vendors =0;
        $vendor_services = 0;
       // $vendor_equep =0;
        $events = 0;
        $packs =0;
        $exp_mony=0;
        $all_vendor_mony =0;
        $resceved_mony=0;
        $wanted_mony=0;

        foreach ($organization_ids as $organization_id) {
            $db = DBConnection($organization_id);
            $halls += $db->table('halls')->count();
            $vendors += $db->table('vendors')->count();
            $vendor_services += $db->table('supplier_services')->count();
           // $vendor_equep += $db->table('rent_contracts')->count();
            $events += $db->table('reservations')->count();
            $packs += $db->table('packages')->count();

            $exp_mony += $db->table('reservations')->sum('actual_price');
            $resceved_mony += $db->table('reservations')->sum('paid_amount');
            $wanted_mony += $db->table('reservations')->sum('remaining_amount');
            $all_vendor_mony += $db->table('reservations')->sum('supplier_remaining_amount');
        }

        ElwezaraDBConnection();

        $stats = [
            'halls'=>$halls,
            'vendors'=>$vendors,
            'vendor_services'=>$vendor_services,
            'events'=>$events,
            'packs'=>$packs,
            'exp_mony'=>$exp_mony,
            'all_vendor_mony'=>$all_vendor_mony,
            'resceved_mony'=>$resceved_mony,
            'wanted_mony'=>$wanted_mony

        ];


        return view('Admin::events',compact('stats'));
    }
}
