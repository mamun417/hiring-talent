<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talent', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('talent_name')->nullable();
            $table->string('parent_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('shirt_size')->nullable();
            $table->string('pant_size')->nullable();
            $table->string('shoe_size')->nullable();
            $table->string('ethnicity_one')->nullable();
            $table->string('ethnicity_two')->nullable();
            $table->string('mail_address')->nullable();
            $table->string('subject')->nullable();
            $table->integer('referred_by')->nullable();
            $table->text('message')->nullable();
            $table->string('la_casting_profile_link')->nullable();
            $table->string('actor_access_profile_link')->nullable();
            $table->string('website')->nullable();
            $table->string('imdb_page')->nullable();
            $table->text('represent_agency')->nullable();
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
        Schema::dropIfExists('talent');
    }
}
