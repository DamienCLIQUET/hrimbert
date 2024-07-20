<?php

use App\Models\Typeaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('typeactions', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 255);
            $table->timestamps();
        });

        Typeaction::create([
            'id' => '1',
            'designation' => 'Appel reçu'
        ]);
        Typeaction::create([
            'id' => '2',
            'designation' => 'Appel passé'
        ]);
        Typeaction::create([
            'id' => '3',
            'designation' => 'Email reçu'
        ]);
        Typeaction::create([
            'id' => '4',
            'designation' => 'Email envoyé'
        ]);
        Typeaction::create([
            'id' => '5',
            'designation' => 'SMS reçu'
        ]);
        Typeaction::create([
            'id' => '6',
            'designation' => 'SMS envoyé'
        ]);
        Typeaction::create([
            'id' => '7',
            'designation' => 'RDV fait'
        ]);
        Typeaction::create([
            'id' => '8',
            'designation' => 'Appeler'
        ]);
        Typeaction::create([
            'id' => '9',
            'designation' => 'Envoyer mail'
        ]);
        Typeaction::create([
            'id' => '10',
            'designation' => 'Envoyer SMS'
        ]);
        Typeaction::create([
            'id' => '11',
            'designation' => 'RDV'
        ]);
        Typeaction::create([
            'id' => '12',
            'designation' => 'Autres'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('typeactions');
    }
};