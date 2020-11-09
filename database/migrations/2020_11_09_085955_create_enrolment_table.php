<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enrolment', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('section_id');
            $table->timestamps();

            $table->unique(['student_id', 'section_id']);

            $table->foreign('student_id')->references('student_id')->on('student');
            $table->foreign('section_id')->references('section_id')->on('section');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrolment');
    }
}
