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
            $table->text('terms_and_conditions_en');
            $table->text('about_en');
            $table->text('privacy_policy_en');
            $table->text('terms_and_conditions_ar');
            $table->text('about_ar');
            $table->text('privacy_policy_ar');
            $table->text('terms_and_conditions_he');
            $table->text('about_he');
            $table->text('privacy_policy_he');
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
