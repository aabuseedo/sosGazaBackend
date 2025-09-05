<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
           $table->id();
           $table->string('title');
           $table->text('body');
           $table->string('image')->nullable();
           $table->string('sender', 100)->nullable();
           $table->dateTime('start_at');
           $table->dateTime('end_at');
           $table->enum('status', ['active','expired']);
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
        Schema::dropIfExists('notifications');
    }
};
