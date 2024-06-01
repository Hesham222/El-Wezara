<?php

namespace Admin\Http\Controllers;
use Admin\Models\Organization;
use Carbon\Carbon;
use User\Models\{
    User,
};


class RentDashboardController extends JsonResponse
{
    public function __invoke()
    {

        $organization_ids = Organization::pluck('id');

        $rent_spaces = 0;
        $renters =0;
        $active_renters = 0;
        $contracts =0;
        $active_contracts = 0;
        $end_contarcts =0;
        $exp_mony=0;
        $all_mony =0;
        $resceved_mony=0;


        foreach ($organization_ids as $organization_id) {
            $db = DBConnection($organization_id);
            $rent_spaces += $db->table('rent_spaces')->count();
            $renters += $db->table('rent_contracts')->distinct()->pluck('vendor_id')->count();
            $active_renters += $db->table('rent_contracts')->distinct()->pluck('vendor_id')->count();
            $contracts += $db->table('rent_contracts')->count();
            $active_contracts += $db->table('rent_contracts')->where('end_date','>',Carbon::now())->count();
            $end_contarcts += $db->table('rent_contracts')->where('end_date','<=',Carbon::now())->count();

            $exp_mony += $db->table('rent_contracts')->sum('amount');
            $all_mony += $db->table('rent_contract_payments')->sum('amount');
            $resceved_mony += $db->table('rent_contracts')->sum('amount') - $db->table('rent_contract_payments')->sum('amount') ;
        }

        ElwezaraDBConnection();

        $stats = [
            'rent_spaces'=>$rent_spaces,
            'renters'=>$renters,
            'active_renters'=>$active_renters,
            'contracts'=>$contracts,
            'active_contracts'=>$active_contracts,
            'end_contarcts'=>$end_contarcts,
            'exp_mony'=>$exp_mony,
            'all_mony'=>$all_mony,
            'resceved_mony'=>$resceved_mony,

        ];



        return view('Admin::rents',compact('stats'));
    }
}
