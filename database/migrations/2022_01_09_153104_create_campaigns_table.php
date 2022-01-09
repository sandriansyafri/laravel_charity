<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('short_desc');
            $table->longText('body');
            $table->integer('seen');
            $table->enum('status', ['public', 'pending', 'archived'])->default('pending');
            $table->bigInteger('nominal');
            $table->bigInteger('goal');
            $table->dateTime('end_date');
            $table->text('note');
            $table->string('receiver');
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
        Schema::dropIfExists('campaigns');
    }
}
