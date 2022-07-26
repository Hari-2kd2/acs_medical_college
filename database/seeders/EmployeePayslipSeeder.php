<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeePayslipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        DB::table('print_employee_payslip')->truncate();
        DB::table('print_employee_payslip')->insert(
            [
                [ 'finger_id' => 1000 , 'employee_id' => 'ACSC1111',  'created_at' => $time, 'updated_at' => $time],
                [ 'finger_id' => 1001 , 'employee_id' => 'ACSC1112',  'created_at' => $time, 'updated_at' => $time],
                [ 'finger_id' => 1002 , 'employee_id' => 'ACSC1113',  'created_at' => $time, 'updated_at' => $time],

            ]
        );
    }
}
