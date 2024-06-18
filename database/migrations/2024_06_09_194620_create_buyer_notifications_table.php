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
        Schema::create('buyer_notifications', function (Blueprint $table) {
            
            $table->id();
            $table->string('content');
            $table->string('from_who');
            $table->string('to_who');
            $table->string('linked_id');
            $table->enum('status',['accepted','pending','rejected'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buyer_notifications');
    }
};
