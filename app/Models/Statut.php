<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Statut extends Model {
    use HasFactory;

    protected $fillable = [
        'designation',
        'ordre',
        'couleur',
        'visible'
    ];

    public function chantiers(): HasMany {
        return $this->hasMany(Chantier::class);
    }
}