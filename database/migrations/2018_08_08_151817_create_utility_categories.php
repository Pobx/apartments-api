<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilityCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utility_categories', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('ชื่อสิ่งอำนวยความสะดวก');
            $table->float('price_per_unit_cost', 10, 2)->comment('ราคาต้นทุน น้ำ-ไฟ');
            $table->float('price_per_unit', 10, 2)->comment('ราคาขาย น้ำ-ไฟ');
            $table->float('unit_min_rate', 10, 2)->comment('หน่วยขั้นต่ำ');
            $table->float('unit_min_price', 10, 2)->comment('ราคาขายเหมาหน่วยขั้นต่ำ');
            $table->enum('type', ['unit', 'monthly'])->default('unit')->comment('หน่วย/รายเดือน');
            $table->enum('status', ['active', 'disabled'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utility_categories');
    }
}
