<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpdateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('update', function (Blueprint $table) {
            $table->id();
            $table->string('leave_id');
            $table->string('student_id');
            $table->string('staff_id');
            $table->timestamps();

            $table->foreign('leave_id')->references('leave_id')->on('leave_application');
            $table->foreign('student_id')->references('student_id')->on('student');
            $table->foreign('staff_id')->references('staff_id')->on('staff');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update');
    }
}
