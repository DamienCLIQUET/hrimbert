<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Articledetail extends Model {
    use HasFactory;

    protected $fillable = [
        'article_id',
        'typearticle_id',
        'id_reference',
        'ordre'
    ];

    public function compose(): BelongsTo {
        return $this->belongsTo(Compose::class, 'id_reference');
    }

    public function groupe(): BelongsTo {
        return $this->belongsTo(Groupe::class, 'id_reference');
    }

    public function product(): BelongsTo {
        return $this->belongsTo(Product::class, 'id_reference');
    }
}