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
        Schema::create('guest_payments', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->decimal("amount",8,0);
            $table->string('currency', 3)->default('usd');
            $table->string("reference");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_payments');
    }
};
