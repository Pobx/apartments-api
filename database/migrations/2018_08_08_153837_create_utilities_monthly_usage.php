<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilitiesMonthlyUsage extends Migration
{
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
            $table->dateTime('utility_memo_date')->comment('วันที่บันทึกจาก User');
            $table->float('unit_amount', 10, 2)->comment('ปริมาณการใช้งาน หน่วย');
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
        Schema::dropIfExists('utilities_monthly_usage');
    }
}
