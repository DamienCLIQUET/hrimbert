<?php

use App\Models\Typechantier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('typechantiers', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 255);
            $table->timestamps();
        });

        Typechantier::create([
            'id' => '1',
            'designation' => 'Normal',
        ]);
        Typechantier::create([
            'id' => '2',
            'designation' => 'Urgence',
        ]);
        Typechantier::create([
            'id' => '3',
            'designation' => 'Contrat',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('typechantiers');
    }
};