<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Fournisseur::class)->constrained()->nullable();
            $table->foreignIdFor(App\Models\Article::class)->constrained();
            $table->string('designation', 255);
            $table->string('reffab', 255)->nullable();
            $table->string('refdistrib', 255)->nullable();
            $table->foreignIdFor(App\Models\Fabricant::class)->constrained()->nullable();
            $table->integer('tarifachat')->default('0');
            $table->integer('tarifpublic')->default('0');
            $table->integer('tarifvente')->default('0');
            $table->timestamps();
        });

        Schema::create('groupe_product', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Groupe::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(App\Models\Product::class)->constrained()->cascadeOnDelete();
            $table->integer('quantite');
            $table->primary(['groupe_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('products');
    }
};