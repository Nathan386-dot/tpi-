<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provenance extends Model
{
    use HasFactory;

    // Définir la table associée au modèle
    protected $table = 'provenances';

    // Définir les colonnes qui peuvent être attribuées en masse
    protected $fillable = ['provenance_name'];

    // Si votre table n'utilise pas les colonnes 'created_at' et 'updated_at'
    public $timestamps = false;
}
