<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionProgramLogDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_program_log_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('subscription_program_logs_id')->unsigned()->nullable(false);
            $table->foreign('logs_id')->references('id')->on('subscription_program_logs')->onDelete('cascade');
            $table->integer('set');
            $table->integer('repeticiones')->nullable();
            $table->string('peso')->nullable();
            $table->index(['subscription_program_logs_id','set']);
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
        Schema::dropIfExists('subscription_program_log_details');
    }
}
