<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Categorie extends Model {
    use HasFactory;

    protected $fillable = [
        'designation'
    ];

    public function souscategories(): BelongsToMany {
        return $this->belongsToMany(Categorie::class, 'categorie_categorie', 'categorie_id_1', 'categorie_id_2');
    }

    public function surcategories(): BelongsToMany {
        return $this->belongsToMany(Categorie::class, 'categorie_categorie', 'categorie_id_2', 'categorie_id_1');
    }
}