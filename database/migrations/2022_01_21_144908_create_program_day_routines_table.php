<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramDayRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_day_routines', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('video')->nullable(false);
            $table->integer('sets')->nullable(false);
            $table->integer('repetitions')->nullable(false);
            
            $table->bigInteger('program_day_id')->unsigned()->nullable(false);
            $table->bigInteger('status_id')->unsigned()->nullable(false);
            $table->bigInteger('user_id')->unsigned()->nullable(false);

            $table->foreign('program_day_id')->references('id')->on('program_days')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
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
        Schema::dropIfExists('program_day_routines');
    }
}
