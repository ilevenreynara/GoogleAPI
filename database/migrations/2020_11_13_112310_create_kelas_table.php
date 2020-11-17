<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->string('kelas_id')->primary();
            $table->string('kelas_name');
            $table->string('kelas_section')->nullable();
            $table->string('kelas_description')->nullable();
            $table->string('kelas_description_heading')->nullable();
            $table->string('kelas_state');
            $table->string('kelas_room');
            $table->string('kelas_ownerId');
            $table->string('kelas_course')->unsigned();
            $table->foreign('kelas_course')->references('course_id')->on('courses');
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
        Schema::dropIfExists('kelas');
    }
}
