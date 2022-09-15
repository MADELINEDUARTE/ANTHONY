<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCamposTableSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->char("street1", 250)->nullable();
            $table->char("street2", 250)->nullable();
            $table->char("city", 250)->nullable();
            $table->char("state", 250)->nullable();
            $table->char("zip", 250)->nullable();
            $table->char("country", 250)->nullable();
            $table->char("company", 250)->nullable();
            $table->char("phone", 250)->nullable();
            $table->text('easy_post_adress_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
