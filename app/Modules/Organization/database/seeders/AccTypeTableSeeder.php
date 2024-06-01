<?php

namespace Database\Seeders;

use Organization\Models\AccType;
use Illuminate\Database\Seeder;

class AccTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccType::create([
            'name' => "الحسابات المدينة - مدين"
        ]);
        AccType::create([
            'name' => "الحسابات الدائنة - دائن"
        ]);
    }
}
