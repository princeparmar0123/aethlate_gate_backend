<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile')->unique();
            $table->enum('type', ['vendor', 'user', 'staff'])->default('user'); // Set default to 'user'
            $table->string('email')->unique();
            $table->string('city')->nullable();
            $table->string('password');
            $table->string('otp')->unique()->nullable();
            $table->string('otp_created_at')->nullable();
            $table->string('termsofservice')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
