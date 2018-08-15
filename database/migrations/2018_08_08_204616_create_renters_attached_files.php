<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentersAttachedFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renters_attached_files', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('renters_id')->unsigned();
            $table->foreign('renters_id')->references('id')->on('renters');
            $table->string('attached_name', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('ชื่อไฟล์');
            // $table->string('attached_path', 200)->nullable(true)->default(null)->collation('utf8mb4_general_ci');
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
        Schema::dropIfExists('renters_attached_files');
    }
}
