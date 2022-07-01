<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionProgramLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_program_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('program_days_id')->unsigned()->nullable(false);
            $table->foreign('program_days_id')->references('id')->on('program_days')->onDelete('cascade');

            $table->bigInteger('program_day_routines_id')->unsigned()->nullable(false);
            $table->foreign('program_day_routines_id')->references('id')->on('program_day_routines')->onDelete('cascade');
            
            $table->bigInteger('subscription_programs_id')->unsigned()->nullable(false);
            $table->foreign('subscription_programs_id')->references('id')->on('subscription_programs')->onDelete('cascade');
            
            $table->integer('status');
            $table->integer('is_complete')->default(0);
            
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
        Schema::dropIfExists('subscription_program_logs');
    }
}
