<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('ชื่อห้อง');
            $table->foreign('apartment_id')->references('id')->on('apartments');
            $table->foreign('room_categories_id')->references('id')->on('room_categories');
            $table->float('price', 8, 2)->comment('ราคาห้องพัก');
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
        Schema::dropIfExists('rooms');
    }
}
