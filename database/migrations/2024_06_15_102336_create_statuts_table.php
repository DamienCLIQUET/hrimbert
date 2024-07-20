<?php

use App\Models\Statut;
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

        Statut::create([
            'id' => '1',
            'designation' => 'RDV A PRENDRE POUR DEVIS (Hervé)',
            'ordre' => '1',
            'couleur' => 'purple'
        ]);
        Statut::create([
            'id' => '2',
            'designation' => 'INFO A COMPLETER',
            'ordre' => '2',
            'couleur' => '#ff8da1'
        ]);
        Statut::create([
            'id' => '3',
            'designation' => 'DEVIS A FAIRE (Hervé)',
            'ordre' => '3',
            'couleur' => 'orange'
        ]);
        Statut::create([
            'id' => '4',
            'designation' => 'DEVIS A ENVOYER (Lise)',
            'ordre' => '4',
            'couleur' => 'green'
        ]);
        Statut::create([
            'id' => '5',
            'designation' => 'DEVIS EN ATTENTE à relancer (Lise)',
            'ordre' => '5',
            'couleur' => 'gray'
        ]);
        Statut::create([
            'id' => '6',
            'designation' => 'EN ATTENTE retour client',
            'ordre' => '6',
            'couleur' => 'yellowgreen'
        ]);
        Statut::create([
            'id' => '7',
            'designation' => 'CHANTIER A PLANIFIER (Hervé)',
            'ordre' => '7',
            'couleur' => 'blue'
        ]);
        Statut::create([
            'id' => '8',
            'designation' => 'CHANTIER PREVU / EN COURS (Hervé)',
            'ordre' => '8',
            'couleur' => '#e92fff'
        ]);
        Statut::create([
            'id' => '9',
            'designation' => 'CHANTIER A FACTURER (Lise)',
            'ordre' => '9',
            'couleur' => 'red'
        ]);
        Statut::create([
            'id' => '10',
            'designation' => 'CHANTIER EN ATTENTE DE PAIEMENT (Lise)',
            'ordre' => '10',
            'couleur' => 'brown'
        ]);
        Statut::create([
            'id' => '11',
            'designation' => 'CHANTIER CLOTURE',
            'ordre' => '11',
            'couleur' => 'black'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('statuts');
    }
};