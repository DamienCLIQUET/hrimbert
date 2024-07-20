<?php

use App\Models\Articledetail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('articledetails', function (Blueprint $table) {
            $table->foreignIdFor(App\Models\Article::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(App\Models\Typearticle::class)->constrained()->cascadeOnDelete();
            $table->integer('id_reference');
            $table->integer('ordre');
            $table->timestamps();
        });

        Articledetail::create([
            'article_id' => '1',
            'typearticle_id' => '1',
            'id_reference' => '1',
            'ordre' => '1'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('articledetails');
    }
};