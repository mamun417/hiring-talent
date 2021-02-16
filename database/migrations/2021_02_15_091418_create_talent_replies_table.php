<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTalentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('talent_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talent_id')->constrained('talent')->cascadeOnDelete();
            $table->string('subject');
            $table->string('talent_email');
            $table->longText('message_body')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('talent_replies');
    }
}
