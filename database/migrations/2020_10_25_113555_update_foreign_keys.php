<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('session', function (Blueprint $table) {
            $table->foreign('section_id')->references('section_id')->on('section');
        });

        Schema::table('section', function (Blueprint $table) {
            $table->foreign('lecturer_id')->references('staff_id')->on('staff');
            $table->foreign('course_id')->references('course_id')->on('course');
        });

        Schema::table('leave_action', function (Blueprint $table) {
            $table->foreign('leave_id')->references('leave_id')->on('leave_application');
            $table->foreign('staff_id')->references('staff_id')->on('staff');
            $table->foreign('course_id')->references('course_id')->on('course');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropForeign('session');
        Schema::dropForeign('section');
        Schema::dropForeign('leave_action');
    }
}
