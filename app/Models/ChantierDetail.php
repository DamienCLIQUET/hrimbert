<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chantierdetail extends Model {
    use HasFactory;

    protected $fillable = [
        'chantier_id',
        'type_id',
        'remise',
        'prix',
        'vudevis',
        'avancement',
        'ordre'
    ];
}