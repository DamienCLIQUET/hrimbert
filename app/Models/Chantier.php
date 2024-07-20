<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Chantier extends Model {
    use HasFactory;

    protected $fillable = [
        'id',
        'lieu_id',
        'nom',
        'statut_id',
        'commentaire',
        'commentaireadmin',
        'commentairetechnique',
        'accompt',
        'tva',
        'remise',
        'typechantier_id',
        'date'
    ];

    public function action(): HasOne {
        return $this->hasOne(Action::class);
    }

    public function actions(): HasMany {
        return $this->hasMany(Action::class);
    }

    public function chantierdetails(): HasMany {
        return $this->hasMany(Chantierdetail::class);
    }

    public function lieu(): BelongsTo {
        return $this->belongsTo(Lieu::class, 'lieu_id');
    }

    public function lieus(): BelongsToMany {
        return $this->belongsToMany(Lieu::class, 'lieu_id');
    }

    public function statut(): BelongsTo {
        return $this->belongsTo(Statut::class, 'statut_id');
    }

    public function statuts(): BelongsToMany {
        return $this->belongsToMany(Statut::class, 'statut_id');
    }

    public function typechantier(): BelongsTo {
        return $this->belongsTo(Typechantier::class, 'typechantier_id');
    }

    public function typechantiers(): BelongsToMany {
        return $this->belongsToMany(Typechantier::class, 'typechantier_id');
    }
}