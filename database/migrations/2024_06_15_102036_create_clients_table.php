<?php

use App\Models\Client;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->string('prenom', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('tel', 255)->nullable();
            $table->string('gsm', 255)->nullable();
            $table->timestamps();
        });

        Client::create([
            'id' => '1',
            'nom' => 'CLIQUET',
            'prenom' => 'Damien',
            'email' => 'd.cliquet@gmail.com',
            'tel' => '',
            'gsm' => '0682578631'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('clients');
    }
};