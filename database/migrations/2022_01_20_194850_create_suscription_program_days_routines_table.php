<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuscriptionProgramDaysRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_program_day_routines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subscription_programs_id')->unsigned()->nullable(false);
            $table->bigInteger('program_days_id')->unsigned()->nullable(false);
            $table->bigInteger('user_id')->unsigned()->nullable(false);
            $table->foreign('subscription_programs_id','spd1_routine_foreign')->references('id')->on('subscription_programs')->onDelete('cascade');
            $table->foreign('program_days_id','spd2_routine_foreign')->references('id')->on('program_days')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription_program_day_routines');
    }
}
