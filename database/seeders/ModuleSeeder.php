<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->truncate();
        DB::table('modules')->insert(
            [
                ['name' => 'Administration','icon_class' => 'mdi mdi-contacts'],
                ['name' => 'My Profile','icon_class' => 'mdi mdi-account-multiple-plus'],
                ['name' => 'Payroll','icon_class' => 'mdi mdi-cash'],
            ]
        );
    }
}
