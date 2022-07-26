<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_permission')->truncate();
        DB::insert("INSERT INTO `menu_permission` (`id`, `role_id`, `menu_id`) VALUES
        (1, 1, 9),
        (3, 1, 38),
        (4, 1, 76),
        (5, 1, 79)");

    }
}
