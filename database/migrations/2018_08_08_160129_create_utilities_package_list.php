<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtilitiesPackageList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utilities_package_list', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('utilities_packages_id')->unsigned();
            $table->integer('utility_categories_id')->unsigned();
            $table->foreign('utilities_packages_id')->references('id')->on('utilities_packages');
            $table->foreign('utility_categories_id')->references('id')->on('utility_categories');
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
        Schema::dropIfExists('utilities_package_list');
    }
}
