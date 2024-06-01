<?php

namespace Admin\Http\Controllers;
use Admin\Models\Organization;
use User\Models\{
    User,
};


class HRDashboardController extends JsonResponse
{
    public function __invoke()
    {

        $organization_ids = Organization::pluck('id');

        $depts = 0;
        $vac_req =0;
        $vac_req_pending = 0;
        $vac_req_pending_approved =0;
        $vac_req_pending_rejected = 0;
        $ded_req =0;
        $ded_req_pending = 0;
        $ded_req_pending_approved =0;
        $ded_req_pending_rejected = 0;
        $ded_full_price =0;
        $ded_rejected_price=0;
        $bonices =0;
        $bonies_price =0;

        $num_of_nuynos =0;
        $notouns_price =0;
        $salaries = 0;

        foreach ($organization_ids as $organization_id) {
            $db = DBConnection($organization_id);
            $depts += $db->table('departments')->count();
            $vac_req += $db->table('vacation_requests')->count();
            $vac_req_pending += $db->table('vacation_requests')->where('status','Pending')->count();
            $vac_req_pending_approved += $db->table('vacation_requests')->where('status','Approved')->count();
            $vac_req_pending_rejected += $db->table('vacation_requests')->where('status','Rejected')->count();


            $ded_req += $db->table('financial_advance_requests')->count();
            $ded_req_pending += $db->table('financial_advance_requests')->where('status','Pending')->count();
            $ded_req_pending_approved += $db->table('financial_advance_requests')->where('status','Approved')->count();
            $ded_req_pending_rejected += $db->table('financial_advance_requests')->where('status','Rejected')->count();
            $ded_full_price += $db->table('financial_advance_requests')->sum('amount');
            $ded_rejected_price += $db->table('financial_advance_requests')->where('status','Rejected')->sum('amount');


            $bonices += $db->table('employee_bonuses')->count();
            $bonies_price += $db->table('employee_bonuses')->sum('amount');

            $num_of_nuynos += $db->table('employee_deductions')->count();
            $notouns_price += $db->table('employee_deductions')->sum('amount');

            $emps = $db->table('employees')->get();

            foreach ($emps as $emp)
            {
                $salaries += $emp->net_salary;

            }




        }

        ElwezaraDBConnection();

        $stats = [
            'depts'=>$depts,
            'vac_req'=>$vac_req,
            'vac_req_pending'=>$vac_req_pending,
            'vac_req_pending_approved'=>$vac_req_pending_approved,
            'vac_req_pending_rejected'=>$vac_req_pending_rejected,
            'ded_req'=>$ded_req,
            'ded_req_pending'=>$ded_req_pending,
            'ded_req_pending_approved'=>$ded_req_pending_approved,
            'ded_req_pending_rejected'=>$ded_req_pending_rejected,
            'ded_full_price'=>$ded_full_price,
            'ded_rejected_price'=>$ded_rejected_price,
            'bonices'=>$bonices,
            'bonies_price'=>$bonies_price,
            'num_of_nuynos'=>$num_of_nuynos,
            'notouns_price'=>$notouns_price,
            'salaries'=>$salaries,

        ];

        return view('Admin::human-resources',compact('stats'));
    }
}
