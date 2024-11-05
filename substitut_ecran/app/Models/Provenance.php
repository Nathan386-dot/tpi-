<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'provenance_name',
        'provenance_details', // Ajoutez d'autres champs si nécessaire
    ];
}
