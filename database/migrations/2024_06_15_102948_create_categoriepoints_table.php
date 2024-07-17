<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('categoriepoints', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 255);
            $table->timestamps();
        });

        Schema::create('categoriepoint_point', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Categoriepoint::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(App\Models\Point::class)->constrained()->cascadeOnDelete();
            $table->primary(['categoriepoint_id', 'point_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('categoriepoints');
    }
};