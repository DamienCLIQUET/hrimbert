<?php

use App\Models\Action;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Chantier::class)->constrained();
            $table->string('designation', 255);
            $table->foreignIdFor(App\Models\Typeaction::class)->constrained();
            $table->foreignIdFor(App\Models\User::class)->constrained();
            $table->date('date');
            $table->timestamps();
        });

        Action::create([
            'id' => '1',
            'chantier_id' => '2',
            'designation' => 'Test',
            'typeaction_id' => '1',
            'user_id' => '1',
            'date' => '2024-07-01'
        ]);
        Action::create([
            'id' => '2',
            'chantier_id' => '2',
            'designation' => 'Test2',
            'typeaction_id' => '2',
            'user_id' => '1',
            'date' => '2024-07-02'
        ]);
        Action::create([
            'id' => '3',
            'chantier_id' => '2',
            'designation' => 'Test3',
            'typeaction_id' => '3',
            'user_id' => '1',
            'date' => '2024-07-03'
        ]);
        Action::create([
            'id' => '4',
            'chantier_id' => '2',
            'designation' => 'Test4',
            'typeaction_id' => '4',
            'user_id' => '1',
            'date' => '2024-07-04'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actions');
    }
};
