<?php

use App\Models\Lieu;
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

        Lieu::create([
            'id' => '1',
            'client_id' => '1',
            'designation' => 'Domicile',
            'adresse' => '17A, Rue des bruyères',
            'codepostal' => '27670',
            'ville' => 'SAINT OUEN DU TILLEUIL'
            ]);
        Lieu::create([
            'id' => '2',
            'client_id' => '1',
            'designation' => 'Melpro',
            'adresse' => '9, Rue condorcet',
            'codepostal' => '76300',
            'ville' => 'SOTTEVILLE LES ROUEN'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('lieus');
    }
};