<?php

use Admin\Models\Organization;
use Illuminate\Support\Facades\Config;
use Organization\Models\Hotel;
use Organization\Models\HotelReservation;
use Carbon\Carbon;

if (!function_exists('checkAdminPermission')) {
    function checkAdminPermission($permissions,$module)
    {
        //get ability based on ability passed to check
        $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();
        if (is_int(array_search("All-Modules", $rolePermissions)))
            return true;
        elseif (is_int(array_search($module, $rolePermissions)))
            return true;
        else
            return false;
    }
}

if (!function_exists('checkOrganizationAdminPermission')) {
    function checkOrganizationAdminPermission($permissions,$module)
    {
        //get ability based on ability passed to check
        $rolePermissions = \Organization\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();
        if (is_int(array_search("All-Modules", $rolePermissions)))
            return true;
        elseif (is_int(array_search($module, $rolePermissions)))
            return true;
        else
            return false;
    }
}


function changeDBConnection($id)
{

    $organization = Organization::where('id', $id)->first();
    if ($organization) {
        Config::set('database.connections.organization', [
            'driver' => 'mysql',
            'host' => config('database.connections.mysql.host'),
            'database' => 'organization_' . $id,
            'username' => config('database.connections.mysql.username'),
            'password' => config('database.connections.mysql.password'),
        ]);
        Config::set('database.default', 'organization');

    }





}















if (!function_exists('getDayOccoupcety')) {
    function getDayOccoupcety($year,$month,$day,$hotel_id)
    {
        $date =  $year.'-'.$month.'-'.$day;
        $hotel = Hotel::where('id',$hotel_id)->first();
       if($hotel){
        $hotel_reservations = HotelReservation::where('hotel_id',$hotel->id)
        ->where('arrival_date',Carbon::parse($date))->count();
        return  [
            'roomNumber'=>$hotel_reservations,
            'percentage'=> ($hotel_reservations / $hotel->rooms() ) * 100
        ] ;

       }else {
        return  [
            'roomNumber'=>0,
            'percentage'=> 0
        ] ;
       }


    }

    if (!function_exists('checkAdminSideBarInventory')) {
        function checkAdminSideBarInventory($permissions)
        {
            //get ability based on ability passed to check
            $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();

            foreach ($rolePermissions as $rolePermission){

                if (str_contains($rolePermission, 'Modules') == true){
                    return true;
                }
                if ( str_contains($rolePermission, 'Maghzn') == true){

                    return true ;
                }
            }
            return  false ;

        }
    }


    if (!function_exists('checkAdminSideBarClubServices')) {
        function checkAdminSideBarClubServices($permissions)
        {
            //get ability based on ability passed to check
            $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();

            foreach ($rolePermissions as $rolePermission){

                if (str_contains($rolePermission, 'Modules') == true){
                    return true;
                }
                if ( str_contains($rolePermission, 'Unit') == true){

                    return true ;
                }
            }
          return  false ;

        }
    }
    if (!function_exists('checkAdminSideBarActivity')) {
        function checkAdminSideBarActivity($permissions)
        {
            //get ability based on ability passed to check
            $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();

            foreach ($rolePermissions as $rolePermission){

                if (str_contains($rolePermission, 'Modules') == true){
                    return true;
                }
                if ( str_contains($rolePermission, 'SportArea') == true){

                    return true ;
                }
            }
            return  false ;

        }
    }
    if (!function_exists('checkAdminSideBarComponent')) {
        function checkAdminSideBarComponent($permissions)
        {
            //get ability based on ability passed to check
            $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();
 //dd($rolePermissions);
            foreach ($rolePermissions as $rolePermission){

                if (str_contains($rolePermission, 'Modules') == true){
                    return true;
                }
                if ( str_contains($rolePermission, 'Complain') == true){

                    return true ;
                }
            }
            return  false ;

        }
    }
    if (!function_exists('checkAdminSideBarEvent')) {
        function checkAdminSideBarEvent($permissions)
        {
            //get ability based on ability passed to check
            $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();

            foreach ($rolePermissions as $rolePermission){

                if (str_contains($rolePermission, 'Modules') == true){
                    return true;
                }
                if ( str_contains($rolePermission, 'Package') == true){

                    return true ;
                }
            }
            return  false ;

        }
    }
    if (!function_exists('checkAdminSideBarFinance')) {
        function checkAdminSideBarFinance($permissions)
        {
            //get ability based on ability passed to check
            $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();
           // dd($rolePermissions) ;
            foreach ($rolePermissions as $rolePermission){

                if (str_contains($rolePermission, 'Modules') == true){
                    return true;
                }
                if ( str_contains($rolePermission, 'Money') == true){

                    return true ;
                }
            }
            return  false ;

        }
    }
    if (!function_exists('checkAdminSideBarGate')) {
        function checkAdminSideBarGate($permissions)
        {
            //get ability based on ability passed to check
            $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();

            foreach ($rolePermissions as $rolePermission){

                if (str_contains($rolePermission, 'Modules') == true){
                    return true;
                }
                if ( str_contains($rolePermission, 'GateShift') == true){

                    return true ;
                }
            }
            return  false ;

        }
    }
    if (!function_exists('checkAdminSideBarHotel')) {
        function checkAdminSideBarHotel($permissions)
        {
            //get ability based on ability passed to check
            $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();

            foreach ($rolePermissions as $rolePermission){

                if (str_contains($rolePermission, 'Modules') == true){
                    return true;
                }
                if ( str_contains($rolePermission, 'HouseKeeping') == true){

                    return true ;
                }
            }
            return  false ;

        }
    }
    if (!function_exists('checkAdminSideBarHr')) {
        function checkAdminSideBarHr($permissions)
        {
            //get ability based on ability passed to check
            $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();

            foreach ($rolePermissions as $rolePermission){

                if (str_contains($rolePermission, 'Modules') == true){
                    return true;
                }
                if ( str_contains($rolePermission, 'Vacation') == true){

                    return true ;
                }
            }
            return  false ;

        }
    }
    if (!function_exists('checkAdminSideBarLaundry')) {
        function checkAdminSideBarLaundry($permissions)
        {
            //get ability based on ability passed to check
            $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();

            foreach ($rolePermissions as $rolePermission){

                if (str_contains($rolePermission, 'Modules') == true){
                    return true;
                }
                if ( str_contains($rolePermission, 'LaundryService') == true){

                    return true ;
                }
            }
            return  false ;

        }
    }
    if (!function_exists('checkAdminSideBarRent')) {
        function checkAdminSideBarRent($permissions)
        {
            //get ability based on ability passed to check
            $rolePermissions = \Admin\Models\Permission::whereIn('id',$permissions)->pluck('name')->toArray();

            foreach ($rolePermissions as $rolePermission){

                if (str_contains($rolePermission, 'Modules') == true){
                    return true;
                }
                if ( str_contains($rolePermission, 'RentSpace') == true){

                    return true ;
                }
            }
            return  false ;

        }
    }



    if (!function_exists('DBConnection')) {
        function DBConnection($module)
        {
            config(['database.connections.organization' => [
                'driver'     => 'mysql',
                'host'       => config('database.connections.mysql.host'),
                'database'   => 'organization_' . $module,
                'username'   => config('database.connections.mysql.username'),
                'password'   => config('database.connections.mysql.password'),
            ]]);
            Config::set('database.default', 'organization');
            DB::purge('organization');
            return DB::connection('organization');

        }
    }

    if (!function_exists('ElwezaraDBConnection')) {
        function ElwezaraDBConnection()
        {
            config(['database.connections.elwezara' => [
                'driver'     => 'mysql',
                'host'       => config('database.connections.mysql.host'),
                'database'   => 'elwezara',
                'username'   => config('database.connections.mysql.username'),
                'password'   => config('database.connections.mysql.password'),
            ]]);
            Config::set('database.default', 'elwezara');

            return true;

        }
    }




    if (!function_exists('ConvertToArabicDay')) {
        function ConvertToArabicDay($day_name_en)
        {

            $day_name_ar = '';

            if ($day_name_en == 'Saturday')
            {
                $day_name_ar = 'السبت';
            }
            elseif ($day_name_en == 'Sunday')
            {
                $day_name_ar = 'الأحد';

            }
            elseif ($day_name_en == 'Monday')
            {
                $day_name_ar = 'الأثنين';

            }
            elseif ($day_name_en == 'Tuesday')
            {
                $day_name_ar = 'الثلاثاء';

            }
            elseif ($day_name_en == 'Wednesday')
            {
                $day_name_ar = 'الأربعاء';

            }
            elseif ($day_name_en == 'Thursday')
            {
                $day_name_ar = 'الخميس';

            }
            else
            {
                $day_name_ar = 'الجمعة';

            }

            return $day_name_ar;

        }
    }

}
