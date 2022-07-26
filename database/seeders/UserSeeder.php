<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = Carbon::now();

        DB::table('user')->truncate();
        DB::table('user')->insert(
            [
                ['role_id' => 1, 'user_name' => 'admin', 'password' => bcrypt('123'), 'remember_token' => null, 'status' => 1, 'created_by' => 1, 'updated_by' => 1, 'created_at' => $time, 'updated_at' => $time],

            ]
        );
    }
}
