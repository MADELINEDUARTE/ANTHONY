<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoutineLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routine_logs', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('subscription_program_day_routine_id')->unsigned()->nullable(false);
            $table->integer('repetitions')->unsigned()->nullable(false);
            $table->integer('weight')->unsigned()->nullable(false);
            $table->bigInteger('user_id')->unsigned()->nullable(false);
            $table->foreign('subscription_program_day_routine_id','spd_routine_foreign')->references('id')->on('subscription_program_day_routines')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('routine_logs');
    }
}
