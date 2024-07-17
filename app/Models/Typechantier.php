<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typechantier extends Model {
    use HasFactory;

    protected $fillable = [
        'designation'
    ];
}