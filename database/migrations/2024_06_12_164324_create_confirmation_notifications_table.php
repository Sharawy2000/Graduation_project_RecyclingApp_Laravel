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
        Schema::create('confirmation_notifications', function (Blueprint $table) {
            $table->id();
            $table->string("seller_id");
            $table->string("buyer_id");
            $table->string("order_id");
            $table->boolean("seller_response")->default(false);
            $table->boolean("buyer_response")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confirmation_notifications');
    }
};
