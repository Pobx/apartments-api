<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('ชื่อ apartments');
            // $table->smallInteger('status')->comment('0 = in-active, 1 = active');
            $table->enum('status', ['new_apartment', 'active_apartment', 'disabled_apartment', 'maintennace_apartment'])->default('new_apartment');
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
        Schema::dropIfExists('apartments');
    }
}
