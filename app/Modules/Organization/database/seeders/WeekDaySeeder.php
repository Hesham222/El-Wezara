<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Organization\Models\WeekDay;

class WeekDaySeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        WeekDay::create([
            'name' => 'السبت'
        ]);
        WeekDay::create([
            'name' => 'الأحد'
        ]);
        WeekDay::create([
            'name' => 'الأثنين'
        ]);
        WeekDay::create([
            'name' => 'الثلاثاء'
        ]);
        WeekDay::create([
            'name' => 'الأربعاء'
        ]);
        WeekDay::create([
            'name' => 'الخميس'
        ]);
        WeekDay::create([
            'name' => 'الجمعة'
        ]);
    }
}
