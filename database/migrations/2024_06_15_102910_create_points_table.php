<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Plan::class)->constrained();
            $table->string('nom', 255)->nullable();
            $table->integer('x');
            $table->integer('y');
            $table->foreignIdFor(App\Models\Etat::class)->constrained();
            $table->integer('ordre')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('points');
    }
};