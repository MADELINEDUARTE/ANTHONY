<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('last_name')->nullable(false);
            $table->bigInteger('country_id')->unsigned()->nullable(false);
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->text('address')->nullable(false);
            $table->string('email')->unique();

            $table->string('middle_name');
            $table->bigInteger('gender_id')->unsigned()->nullable(false);
            $table->date('date_of_birth')->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('token')->nullable();
            $table->string('telephone')->nullable(false);
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();


            
            // 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
