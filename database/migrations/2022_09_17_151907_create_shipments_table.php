<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->text('shipment_id');

            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

            // Direccion
            $table->text('address_name');
            $table->text('address_street1');
            $table->text('address_street2');
            $table->text('address_city');
            $table->text('address_state');
            $table->text('address_zip');
            $table->text('address_country');
            $table->text('address_email');

            // Envio
            $table->text('tracker_id');
            $table->text('tracker_tracking_code');
            $table->text('tracker_status');
            $table->text('tracker_created_at');
            $table->text('tracker_signed_by');
            $table->text('tracker_carrier');
            $table->text('tracker_public_url');
            
            // Label
            $table->text('label_date');
            $table->text('label_url');

            // Rate
            $table->text('rate_service');
            $table->text('rate_price');
            $table->text('rate_retail_rate');

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
        Schema::dropIfExists('shipments');
    }
}
