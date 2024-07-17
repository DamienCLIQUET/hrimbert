<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lieu extends Model {
    use HasFactory;

    protected $fillable = [
        'id',
        'client_id',
        'designation',
        'adresse',
        'codepostal',
        'ville'
    ];

    public function client(): BelongsTo {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function clients(): BelongsToMany {
        return $this->belongsToMany(Client::class, 'client_id');
    }
}