<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Organization\Models\AccountType;

class AccountTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountType::create([
            'acc_type_id' => 1,
            'name' => "الأصول",
        ]);
        AccountType::create([
            'acc_type_id' => 1,
            'name' => "المصروفات",
        ]);
        AccountType::create([
            'acc_type_id' => 2,
            'name' => "ايراد",
        ]);
        AccountType::create([
            'acc_type_id' => 2,
            'name' => "التزام",
        ]);
        AccountType::create([
            'acc_type_id' => 2,
            'name' => "حقوق ملكية",
        ]);
    }
}
