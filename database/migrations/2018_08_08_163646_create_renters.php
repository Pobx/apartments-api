<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renters', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('first_name', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('ชื่อ');
            $table->string('last_name', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('สกุล');
            $table->string('id_card', 13)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('เลขบัตรประชาชน');
            $table->date('date_of_birth')->nullable(true)->comment('วันเกิด');
            $table->longText('address')->nullable(true)->comment('ที่อยู่');
            $table->string('attached_file_image', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('รูปผู้เช่า');
            $table->string('mobile', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('เบอร์มือถือ');
            $table->string('email', 100)->nullable(true)->default(null)->collation('utf8mb4_general_ci')->comment('อีเมล์');
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
        Schema::dropIfExists('renters');
    }
}
