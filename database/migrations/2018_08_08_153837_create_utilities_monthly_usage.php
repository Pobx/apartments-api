<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilitiesMonthlyUsage extends Migration
{
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('utilities_monthly_usage');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilities_monthly_usage', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('room_id')->nullable(true)->default(null)->unsigned();
            $table->integer('utility_categories_id')->nullable(true)->default(null)->unsigned();
            $table->foreign('utility_categories_id')->references('id')->on('utility_categories');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->dateTime('utility_memo_date')->nullable(true)->default(null)->comment('วันที่บันทึกจาก User');
            $table->float('latest_unit_amount', 10, 2)->nullable(true)->default(null)->comment('การใช้งานก่อนหน้า หน่วย');
            $table->float('current_unit_amount', 10, 2)->nullable(true)->default(null)->comment('เลขมิเตอร์ปัจจุบัน หน่วย');
            $table->float('unit_amount', 10, 2)->nullable(true)->default(null)->comment('ปริมาณการใช้งาน หน่วย');
            $table->float('price_per_unit', 10, 2)->nullable(true)->default(null)->comment('ราคาต่อหน่วย');
            $table->float('total_price', 10, 2)->nullable(true)->default(null)->comment('ราคารวม');
            $table->enum('status', ['active', 'disabled'])->default('active');
            $table->timestamps();
        });
    }
}
