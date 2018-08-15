<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilitiesPackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilities_packages', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('ชื่อ package');
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
        Schema::dropIfExists('utilities_packages');
    }
}
