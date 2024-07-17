<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Action extends Model {
    use HasFactory;

    protected $fillable = [
        'chantier_id',
        'designation',
        'typeaction_id',
        'user_id',
        'date'
    ];

    public function chantier(): BelongsTo {
        return $this->belongsTo(Chantier::class, 'chantier_id');
    }

    public function chantiers(): BelongsToMany {
        return $this->belongsToMany(Chantier::class, 'chantier_id');
    }

    public function typeaction(): BelongsTo {
        return $this->belongsTo(Typeaction::class, 'typeaction_id');
    }

    public function typeactions(): BelongsToMany {
        return $this->belongsToMany(Typeaction::class, 'typeaction_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'user_id');
    }
}