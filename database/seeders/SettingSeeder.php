<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                [
                    'useTwoStepAuth' => false,
                    'useReservedPassword' => false,
                    'suspiciousLoginNotifications' => false,
                    'useCodeWord' => false,
                    'user_id' => 1
                ],
                [
                    'useTwoStepAuth' => true,
                    'useReservedPassword' => false,
                    'suspiciousLoginNotifications' => true,
                    'useCodeWord' => true,
                    'user_id' => 2,
                ],
                [
                    'useTwoStepAuth' => false,
                    'useReservedPassword' => false,
                    'suspiciousLoginNotifications' => false,
                    'useCodeWord' => false,
                    'user_id' => 3,
                ]
            ],
        );
    }
}
