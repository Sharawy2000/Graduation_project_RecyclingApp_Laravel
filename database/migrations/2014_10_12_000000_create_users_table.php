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
            $table->string('email');
            $table->string('password');
            $table->string('phone_number')->nullable();
            $table->string('user_type')->nullable();
            $table->string('organization')->nullable();
            $table->string('TIN')->nullable();
            $table->decimal('balance')->nullable();
            $table->decimal('commision')->nullable();
            // add commision to table
            $table->enum('role', ['admin', 'user'])->default('user');
            $table->string('governorate')->nullable();
            $table->string('city')->nullable();
            $table->String('street')->nullable();
            $table->String('residential_quarter')->nullable();

            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->String('social_id')->nullable();
            $table->String('social_type')->nullable();

            //delete cascade if user is deleted all it posts deleted also 
            

            

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
