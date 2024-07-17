<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('chantierdetails', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Chantier::class)->constrained();
            $table->integer('detail');
            $table->foreignIdFor(App\Models\Type::class)->constrained();
            $table->integer('remise')->default('0');
            $table->integer('prix')->default('0');
            $table->integer('vudevis')->default('0');
            $table->integer('avancement')->default('0');
            $table->integer('ordre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('chantierdetails');
    }
};