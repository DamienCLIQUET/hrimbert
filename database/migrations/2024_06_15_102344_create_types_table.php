<?php

use App\Models\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 255);
            $table->timestamps();
        });
        
        Type::create([
            'id' => '1',
            'designation' => 'titre'
        ]);
        Type::create([
            'id' => '2',
            'designation' => 'article'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('types');
    }
};