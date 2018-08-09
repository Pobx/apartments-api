<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_categories')->insert([
            ['name' => 'รายวัน', 'status' => 'active'],
            ['name' => 'รายเดือน', 'status' => 'active'],
        ]);
    }
}
