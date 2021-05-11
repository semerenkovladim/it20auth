<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\Cloner\Data;

class AdminSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_settings')->insert([
            [
                'surname' => true,
                'name' => true,
                'patronymic' => true,
                'email' => true,
                'position' => true,
                'department' => true,
                'date_of_birth' => true, // password
                'role' => true,
                'user_id' => 1
            ],
        ]);
    }
}
