<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_days', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('program_id')->unsigned()->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('description')->nullable(false);
            $table->integer('number')->nullable(false);
            $table->bigInteger('user_id')->unsigned()->nullable(false);
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
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
        Schema::dropIfExists('program_days');
    }
}
