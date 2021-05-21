<?php

namespace Database\Seeders;

use App\Models\AccessLevel;
use App\Models\User;
use Database\Factories\DepartmentFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            [
                'position' => 'Developer',
                'name' => 'Example',
                'surname' => 'Example',
                'middle_name' => 'Example',
                'birth' => Date::now(),
                'date_start' => Date::now(),
                'email' => 'bins.sheridan@example.com',
                'password' => Hash::make('Q3kR2"&Jj><Qj+#X'), // password
                'department_id' => 1,
                'is_admin' => false
            ],
            [
                'position' => 'Developer',
                'name' => 'Example',
                'surname' => 'Example',
                'middle_name' => 'Example',
                'birth' => Date::now(),
                'date_start' => Date::now(),
                'email' => 'katherinebeglaryan@gmail.com',
                'password' => Hash::make('Q3kR2"&Jj><Qj+#X'), // password
                'department_id' => 1,
                'is_admin' => false
            ],
            [
                'position' => 'Developer',
                'name' => 'Example',
                'surname' => 'Example',
                'middle_name' => 'Example',
                'birth' => Date::now(),
                'date_start' => Date::now(),
                'email' => 'admin@email.com',
                'password' => Hash::make('Q3kR2"&Jj><Qj+#X'), // password
                'department_id' => 1,
                'is_admin' => true
            ]
        ]);
        DB::table('access_levels')->insert([
            [
                'account' => 1,
                'disk' => 1,
                'mail' => 1,
                'calendar' => 1,
                'photo' => 1,
                'contacts' => 1,
                'user_id' => 1,
            ],
            [
                'account' => 1,
                'disk' => 1,
                'mail' => 1,
                'calendar' => 1,
                'photo' => 1,
                'contacts' => 1,
                'user_id' => 2,
            ],
            [
                'account' => 1,
                'disk' => 1,
                'mail' => 1,
                'calendar' => 1,
                'photo' => 1,
                'contacts' => 1,
                'user_id' => 3,
            ]
        ]);
        User::factory(30)->create();
        AccessLevel::factory(30)->create();
    }
}
