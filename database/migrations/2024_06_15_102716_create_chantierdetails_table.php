<?php

use App\Models\Chantierdetail;
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
            $table->foreignIdFor(App\Models\Type::class)->constrained();
            $table->integer('id_type');
            $table->integer('remise')->default('0');
            $table->integer('prix')->default('0');
            $table->integer('vudevis')->default('0');
            $table->integer('avancement')->default('0');
            $table->integer('ordre')->default('0');
            $table->timestamps();
        });

        Chantierdetail::create([
            'id' => '1',
            'chantier_id' => '1',
            'type_id' => '1',
            'id_type' => '1',
            'ordre' => '1'
        ]);
        Chantierdetail::create([
            'id' => '2',
            'chantier_id' => '1',
            'type_id' => '2',
            'id_type' => '1',
            'remise' => '1',
            'prix' => '1',
            'vudevis' => '1',
            'avancement' => '50',
            'ordre' => '2'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('chantierdetails');
    }
};