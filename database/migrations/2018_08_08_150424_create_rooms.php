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
            $table->integer('apartments_id')->unsigned();
            $table->integer('room_categories_id')->unsigned();
            $table->foreign('apartments_id')->references('id')->on('apartments');
            $table->foreign('room_categories_id')->references('id')->on('room_categories');
            $table->float('price', 10, 2)->comment('ราคาห้องพัก');
            $table->enum('status', ['active', 'disabled', 'rented_room'])->default('active');
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
