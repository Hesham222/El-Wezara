<?php

namespace Admin\Http\Controllers;
use Admin\Models\Organization;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use User\Models\{
    User,
};


class DashboardController extends JsonResponse
{
    public function __invoke()
    {
        $organization_ids = Organization::pluck('id');
        $club_number = Organization::count();

      $all_emps =0;
      $all_cermonies = 0;
      $all_collected_amount =0;
      $all_reseved_amount =0;
      $all_trainings =0;
      $all_trainers =0;
      $trannigns_amount=0;
      $all_subs=0;
      $all_active_subs=0;
      $all_items=0;
      $inventory_amount=0;
      $all_vendors=0;
      $all_rent_areas =0;
      $active_contracts=0;
      $all_contracts_amount=0;
      $all_active_renters=0;
      $all_monthly_amount_rents=0;
      $all_gates=0;
      $all_gates_amount=0;
      $all_tickets=0;
        foreach ($organization_ids as $organization_id)
        {
            $db = DBConnection($organization_id);
            $all_emps +=  $db->table('employees')->count();
            $all_cermonies +=$db->table('reservations')->count();
            $all_collected_amount +=$db->table('reservations')->sum('actual_price');
            $all_reseved_amount +=$db->table('reservations')->sum('remaining_amount');


            $all_trainings +=  $db->table('trainings')->count();
            $all_trainers +=  $db->table('freelance_trainers')->count();
            $trannigns_amount +=$db->table('subscriptions')->sum('price');
            $all_subs +=$db->table('subscriptions')->count();
            $all_active_subs +=$db->table('subscriptions')->sum('rest_of_paid');



            $all_items +=$db->table('ingredients')->count();
            $inventory_amount +=$db->table('ingredients')->sum('price');
            $all_vendors +=$db->table('vendors')->count();


            $all_rent_areas +=$db->table('rent_spaces')->count();
            $active_contracts +=$db->table('rent_contracts')->count();
            $all_contracts_amount +=$db->table('rent_contracts')->sum('amount');
            $all_active_renters +=$db->table('rent_contracts')->distinct('vendor_id')->count();
            $all_monthly_amount_rents +=$db->table('rent_contracts')->where('durationType','Monthly')->sum('amount');

            $all_gates +=$db->table('gates')->count();
            $all_gates_amount +=$db->table('gate_shift_sheets')->sum('end_balance');
            $all_tickets +=$db->table('tickets')->count();
        }

        ElwezaraDBConnection();

        $stats = [
            'club_number'=>$club_number,
            'all_emps'=>$all_emps,
            'all_cermonies'=>$all_cermonies,
            'all_collected_amount'=>$all_collected_amount,
            'all_reseved_amount'=>$all_reseved_amount,
            'all_trainings'=>$all_trainings,
            'all_trainers'=>$all_trainers,
            'trannigns_amount'=>$trannigns_amount,
            'all_subs'=>$all_subs,
            'all_active_subs'=>$all_active_subs,
            'all_items'=>$all_items,
            'inventory_amount'=>$inventory_amount,
            'all_vendors'=>$all_vendors,
            'all_rent_areas'=>$all_rent_areas,
            'active_contracts'=>$active_contracts,
            'all_contracts_amount'=>$all_contracts_amount,
            'all_active_renters'=>$all_active_renters,
            'all_monthly_amount_rents'=>$all_monthly_amount_rents,
            'all_gates'=>$all_gates,
            'all_gates_amount'=>$all_gates_amount,
            'all_tickets'=>$all_tickets,
            ];
        return view('Admin::home',compact('stats'));
    }
}
