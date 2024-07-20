<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class chantierdetail extends Model {
    use HasFactory;

    protected $fillable = [
        'chantier_id',
        'type_id',
        'id_type',
        'remise',
        'prix',
        'vudevis',
        'avancement',
        'ordre'
    ];

    public function chantier(): BelongsTo {
        return $this->belongsTo(Chantier::class, 'chantier_id');
    }

    public function type(): BelongsTo {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function article(): BelongsTo {
        return $this->belongsTo(Article::class, 'id_type');
    }

    public function titre(): BelongsTo {
        return $this->belongsTo(Titre::class, 'id_type');
    }
}