<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('statuts', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 255);
            $table->integer('ordre')->default('0');
            $table->string('couleur', 255);
            $table->integer('visible')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('statuts');
    }
};