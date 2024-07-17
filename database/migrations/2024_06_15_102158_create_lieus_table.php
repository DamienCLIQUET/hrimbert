<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('lieus', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Client::class)->constrained();
            $table->string('designation', 255);
            $table->string('adresse', 255)->nullable();
            $table->string('codepostal', 255)->nullable();
            $table->string('ville', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('lieus');
    }
};