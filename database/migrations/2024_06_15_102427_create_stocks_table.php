<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Product::class)->constrained();
            $table->integer('stock')->default('0');
            $table->integer('reserve')->default('0');
            $table->integer('commande')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('stocks');
    }
};