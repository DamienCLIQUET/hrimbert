<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('chantiers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Lieu::class)->constrained();
            $table->string('nom', 255);
            $table->foreignIdFor(App\Models\Statut::class)->constrained();
            $table->longtext('commentaire')->nullable();
            $table->longtext('commentaireadmin')->nullable();
            $table->longtext('commentairetechnique')->nullable();
            $table->integer('accompt')->default('0');
            $table->integer('tva')->default('2000');
            $table->integer('remise')->default('0');
            $table->foreignIdFor(App\Models\Typechantier::class)->constrained();
            $table->string('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('chantiers');
    }
};