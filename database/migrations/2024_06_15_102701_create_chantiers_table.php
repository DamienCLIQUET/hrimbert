<?php

use App\Models\Chantier;
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

        Chantier::create([
            'id' => '1',
            'lieu_id' => '1',
            'nom' => 'Test',
            'statut_id' => '1',
            'commentaire' => 'B',
            'commentaireadmin' => 'Bl',
            'commentairetechnique' => 'Bla',
            'accompt' => '10',
            'tva' => '2000',
            'remise' => '0',
            'typechantier_id' => '1',
            'date' => '2024-07-07'
        ]);
        Chantier::create([
            'id' => '2',
            'lieu_id' => '1',
            'nom' => 'Test2',
            'statut_id' => '2',
            'commentaire' => 'B',
            'commentaireadmin' => 'Bl',
            'commentairetechnique' => 'Bla',
            'accompt' => '0',
            'tva' => '2000',
            'remise' => '0',
            'typechantier_id' => '2',
            'date' => '2024-07-07'
        ]);
        Chantier::create([
            'id' => '3',
            'lieu_id' => '2',
            'nom' => 'Test3',
            'statut_id' => '3',
            'commentaire' => 'B',
            'commentaireadmin' => 'Bl',
            'commentairetechnique' => 'Bla',
            'accompt' => '0',
            'tva' => '1000',
            'remise' => '0',
            'typechantier_id' => '3',
            'date' => '2024-07-07'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('chantiers');
    }
};