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
            $table->string('site_name',200);
            $table->string('site_description',500);
            $table->text('site_verification');
            $table->string('first_last_name',100);
            $table->string('email_adress',100);
            $table->string('job_title',100);
            $table->string('profile_image',400);
            $table->integer('site_active');
            $table->string('site_linkedin',300);
            $table->string('site_instagram',300);
            $table->string('site_github',300);
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
        Schema::dropIfExists('settings');
    }
}
