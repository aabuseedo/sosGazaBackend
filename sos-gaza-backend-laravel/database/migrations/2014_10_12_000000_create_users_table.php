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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 20)->unique();
            $table->string('password');
            $table->string('address')->nullable();
            $table->enum('health_status', ['سليم','قلب','ضغط','سكري','ربو','مرض اخر'])->default('سليم');
            $table->enum('blood_type', ['A+','A-','B+','B-','O+','O-','AB+','AB-','لا أعرف'])->nullable();
            $table->string('emergency_contact', 20)->nullable();
            $table->string('photo')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
