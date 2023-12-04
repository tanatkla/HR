<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeaveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('leave_types')->insert([
            [
                'name' => 'ลาป่วย',
            ],
            [
                'name' => 'ลากิจ',
            ],
            [
                'name' => 'ลาพักร้อน',
            ],
            [
                'name' => 'ลาคลอด',
            ],
            [
                'name' => 'ลาฝึกอบรม',
            ],

        ]);
    }
}
