<?php
namespace Admin\Actions\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Admin\Models\{
    Organization
};
class StoreAction
{
    public function execute(Request $request)
    {





        $is_used = 0 ;
        $organization_ids = Organization::pluck('id');
        foreach ($organization_ids as $organization_id)
        {
            $db = DBConnection($organization_id);

            $all_admins = $db->table('organization_admins')->pluck('name');

            foreach ($all_admins as $admin)
            {
                if ($admin == $request->input('name'))
                {
                    $is_used = 1;
                 //   dd('dddddd');
                   return back()->with('error','his name is used try new one !');
                }
            }

            if ($is_used == 1){
               // dd('ccccc');
                return back()->with('error','his name is used try new one !');
            }

        }

        DB::purge('organization');
        Config::set('database.default', env('DB_CONNECTION', 'mysql'));


        $record =  Organization::create([
            'name'       => $request->input('name'),
            'address'      => $request->input('address'),
        ]);
        return $record;



    }
}
