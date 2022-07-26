<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->truncate();
        DB::insert("INSERT INTO `menus` (`id`, `parent_id`, `action`, `name`, `menu_url`, `module_id`, `status`) VALUES
                (1, 0, NULL, 'User', 'user.index', 1, 2),
                (9, 0, NULL, 'Change Password', 'changePassword.index', 2, 1),
                (38, 0, NULL, 'Salary Sheet', NULL, 3, 1),
                (76, 0, NULL, 'Download Payslip', 'downloadPayslip.payslip', 3, 1),
                (79, 0, NULL, 'Upload Salary Details', 'uploadSalaryDetails.uploadSalaryDetails', 3, 1)");

    }
}
