<?php

use App\Models\Product;
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
            $table->string('designation', 255);
            $table->string('reffab', 255)->nullable();
            $table->string('refdistrib', 255)->nullable();
            $table->foreignIdFor(App\Models\Fabricant::class)->constrained()->nullable();
            $table->integer('tarifachat')->default('0');
            $table->integer('tarifpublic')->default('0');
            $table->integer('tarifvente')->default('0');
            $table->timestamps();
        });

        Product::create([
            'id' => '1',
            'fournisseur_id' => '1',
            'designation' => 'ProduitMelpro1',
            'reffab' => '1',
            'refdistrib' => '1',
            'fabricant_id' => '1',
            'tarifachat' => '1',
            'tarifpublic' => '1',
            'tarifvente' => '1'
        ]);
        
        Schema::create('groupe_product', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Groupe::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(App\Models\Product::class)->constrained()->cascadeOnDelete();
            $table->integer('quantite');
            $table->primary(['groupe_id', 'product_id']);
        });

        Schema::create('compose_product', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Compose::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(App\Models\Product::class)->constrained()->cascadeOnDelete();
            $table->integer('quantite');
            $table->primary(['compose_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('products');
    }
};