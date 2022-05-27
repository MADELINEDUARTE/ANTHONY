<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            
            $table->bigInteger('experience_id')->unsigned()->nullable(true);
            $table->foreign('experience_id')->references('id')->on('experiences')->onDelete('cascade');

            $table->bigInteger('reason_id')->unsigned()->nullable(true);
            $table->foreign('reason_id')->references('id')->on('reasons')->onDelete('cascade');

            $table->bigInteger('frequency_id')->unsigned()->nullable(true);
            $table->foreign('frequency_id')->references('id')->on('frequencies')->onDelete('cascade');

            $table->bigInteger('exercise_place_id')->unsigned()->nullable(true);
            $table->foreign('exercise_place_id')->references('id')->on('exercise_places')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('experience_id');
            $table->dropColumn('reason_id');
            $table->dropColumn('frequency_id');
            $table->dropColumn('exercise_place_id');
        });
    }
}
