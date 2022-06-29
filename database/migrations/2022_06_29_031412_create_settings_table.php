<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->integer('trial_days_stripe')->nullable();
            $table->text('pro_tax_id_stripe')->nullable();
            $table->text('dev_tax_id_stripe')->nullable();
            $table->text('pro_secret_key_stripe')->nullable();
            $table->text('pro_public_key_stripe')->nullable();
            $table->text('dev_secret_key_stripe')->nullable();
            $table->text('dev_public_key_stripe')->nullable();
            $table->text('pro_id_facebook')->nullable();
            $table->text('dev_id_facebook')->nullable();
            $table->text('pro_id_google')->nullable();
            $table->text('dev_id_google')->nullable();
            $table->text('timezone')->nullable();
            $table->enum('eviroment',['local','production','dev'])->default('local');
            $table->unsignedInteger('delete')->default(0);
            $table->unsignedInteger('status');
            $table->timestamps();
        });

        //INSERT INTO `settings` (`id`, `company_name`, `trial_days_stripe`, `pro_tax_id_stripe`, `dev_tax_id_stripe`, `pro_secret_key_stripe`, `pro_public_key_stripe`, `dev_secret_key_stripe`, `dev_public_key_stripe`, `pro_id_facebook`, `dev_id_facebook`, `pro_id_google`, `dev_id_google`, `timezone`, `delete`, `status`, `created_at`, `updated_at`, `eviroment`) VALUES (NULL, 'Realworld', '3', '', 'txr_1KiprzFllRtR3x1gD2iN53na', NULL, NULL, 'sk_test_51JFMxBFllRtR3x1grUZN8aDZgeCLo3DULOkOlLsfSSlT2NQRTkYOpgBzxG5VuLB9Q4rxkTxREB7G6hgSL2zGo2WU00RADrrKf6', 'pk_test_51JFMxBFllRtR3x1gBilPZnRFAmn5t6vpZSYDOLR2A14zgdDZUiVvLorUwZiq1ummftz3ZKmWRb4X9DtoBkju4w3g00z410NK5H', NULL, NULL, NULL, NULL, NULL, '0', '1', NULL, NULL, 'local'), (NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '1', NULL, NULL, 'local');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
