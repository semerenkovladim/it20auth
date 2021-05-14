<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            [
                'title' => 'Отдел разработки проектов',
                'head_department' => '1',
            ],
            [
                'title' => 'Отдел сайтов',
                'head_department' => '2',
            ],
            [
                'title' => 'Отдел дизайна',
                'head_department' => '1',
            ],
            [
                'title' => 'Отдел документооборота',
                'head_department' => '2',
            ],
            [
                'title' => 'Отдел дизайна отделов',
                'head_department' => '2',
            ],
            [
                'title' => 'Отдел сайтов отделов',
                'head_department' => '1',
            ],
            [
                'title' => 'Отдел отделов',
                'head_department' => '3',
            ],
            [
                'title' => 'Отдел дизайнеров для дизайна',
                'head_department' => '1',
            ],
            [
                'title' => 'Отдел из отделов',
                'head_department' => '3',
            ],
            [
                'title' => 'Отдел лесничества',
                'head_department' => '3',
            ],
            [
                'title' => 'Отдел в отдел',
                'head_department' => '1',
            ],
            [
                'title' => 'Отдел тестировки',
                'head_department' => '2',
            ],
            [
                'title' => 'Отдел психологов',
                'head_department' => '2',
            ],
            [
                'title' => 'Отдел психологов для психологов',
                'head_department' => '2',
            ],
            [
                'title' => 'Отдел документоразворотов',
                'head_department' => '1',
            ],
            [
                'title' => 'Отдел по борьбе с отделами',
                'head_department' => '2',
            ],
        ]);
    }
}
