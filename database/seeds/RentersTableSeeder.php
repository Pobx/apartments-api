<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('renters')->insert([
            [
                'first_name'          => 'เกียรติพงศ์',
                'last_name'           => 'สิงห์สีโว',
                'id_card'             => '1450700099241',
                'date_of_birth'       => '1987-05-16',
                'address'             => '6/12 ต.สระนกแก้ว อ.โพนทอง จ.ร้อยเอ็ด 45110',
                'attached_file_image' => null,
                'mobile'              => '089-4915453',
                'email'               => 'geidtiphong@gmail.com',
                'status'              => 'active',
                'created_at'          => date('Y-m-d H:i:s'),
                'updated_at'          => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
