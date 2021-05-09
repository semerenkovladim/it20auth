<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccessLevelSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_levels')->insert([
            [
                'account' => true,
                'disk' => true,
                'mail' => true,
                'calendar' => true,
                'photo' => true,
                'contacts' => true,
                'user_id' => 1,
            ],
            [
                'account' => true,
                'disk' => true,
                'mail' => true,
                'calendar' => true,
                'photo' => true,
                'contacts' => true,
                'user_id' => 2,
            ],
            [
                'account' => true,
                'disk' => true,
                'mail' => true,
                'calendar' => true,
                'photo' => true,
                'contacts' => true,
                'user_id' => 3,
            ]
        ]);
    }
}
