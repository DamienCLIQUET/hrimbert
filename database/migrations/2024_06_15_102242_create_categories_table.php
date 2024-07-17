<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('designation', 255);
            $table->timestamps();
        });

        Schema::create('article_categorie', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Article::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(App\Models\Categorie::class)->constrained()->cascadeOnDelete();
            $table->primary(['article_id', 'categorie_id']);
        });

        Schema::create('categorie_categorie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('categorie_id_1');
            $table->unsignedBigInteger('categorie_id_2');
            $table->integer('ordre')->default('0');
            $table->foreign('categorie_id_1')->references('id')->on('categories');
            $table->foreign('categorie_id_2')->references('id')->on('categories');
            $table->unique(['categorie_id_1', 'categorie_id_2']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('categories');
    }
};