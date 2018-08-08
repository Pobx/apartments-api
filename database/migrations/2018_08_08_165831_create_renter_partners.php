<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenterPartners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renter_partners', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('renters_id')->unsigned();
            $table->foreign('renters_id')->references('id')->on('renters');
            $table->string('first_name', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('ชื่อ');
            $table->string('last_name', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('สกุล');
            $table->string('mobile', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('เบอร์มือถือ');
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
        Schema::dropIfExists('renter_partners');
    }
}
