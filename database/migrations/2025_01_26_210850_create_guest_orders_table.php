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
        Schema::create('guest_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("guest_transaction_id")->constrained()->onDelete("cascade");
            $table->foreignId("product_id")->constrained()->onDelete("cascade");
            $table->foreignId("product_size_id")->constrained()->onDelete("cascade");
            $table->decimal("price", 8, 2);
            $table->string("quantity");
            $table->decimal("total", 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_orders');
    }
};
