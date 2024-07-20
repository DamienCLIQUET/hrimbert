<?php

use App\Models\Typearticle;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('typearticles', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 255);
            $table->timestamps();
        });

        Typearticle::create([
            'id' => '1',
            'designation' => 'product'
        ]);
        Typearticle::create([
            'id' => '2',
            'designation' => 'compose'
        ]);
        Typearticle::create([
            'id' => '3',
            'designation' => 'groupe'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('typearticles');
    }
};