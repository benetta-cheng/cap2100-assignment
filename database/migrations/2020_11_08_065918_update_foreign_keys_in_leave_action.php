<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeysInLeaveAction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_action', function (Blueprint $table) {
            $table->string('session_id')->nullable();
            $table->foreign('session_id')->references('session_id')->on('session');
            $table->dropForeign('leave_action_staff_id_foreign');
            $table->dropForeign('leave_action_course_id_foreign');
            $table->dropColumn('staff_id');
            $table->dropColumn('course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_action', function (Blueprint $table) {
            $table->string('staff_id');
            $table->string('course_id');
            $table->foreign('staff_id')->references('staff_id')->on('staff');
            $table->foreign('course_id')->references('course_id')->on('course');
            $table->dropForeign('leave_action_session_id_foreign');
            $table->dropColumn('session_id')->nullable();
        });
    }
}
