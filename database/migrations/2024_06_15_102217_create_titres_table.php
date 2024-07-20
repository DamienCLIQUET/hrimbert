<?php

use App\Models\Titre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('titres', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 255);
            $table->timestamps();
        });

        Titre::create([
            'id' => '1',
            'designation' => 'Titre1'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('titres');
    }
};