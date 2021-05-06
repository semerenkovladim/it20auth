<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BackupDatasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('backup_datas')->insert(
            [
                [
                    'backup_password' => null,
                    'backup_email' => null,
                    'code_word' => null,
                    'user_id' => 1
                ],
                [
                    'backup_password' => null,
                    'backup_email' => null,
                    'code_word' => null,
                    'user_id' => 2
                ],
                [
                    'backup_password' => null,
                    'backup_email' => null,
                    'code_word' => null,
                    'user_id' => 3
                ]
            ],
        );
    }
}
