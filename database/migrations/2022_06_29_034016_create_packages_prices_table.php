<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('packages_id');
            $table->foreign('packages_id')->references('id')->on('packages')->onDelete('cascade');
            $table->unsignedBigInteger('recurrences_id');
            $table->foreign('recurrences_id')->references('id')->on('recurrences')->onDelete('cascade');
            $table->string('amount');
            $table->text('stripe_id');
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
        Schema::dropIfExists('packages_prices');
    }
}
