<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileDAttente extends Model
{
    use HasFactory;

    protected $table = 'file_d_attente'; // Nom de la table

    protected $fillable = [
        'provenance',
        'role',
        'door_number', // Correspond à la porte
        'numero_appel', // Numéro d'appel
    ];

    // Relation avec le modèle User
    public function user()
    {
        // Assurez-vous que la relation est configurée pour utiliser 'door_number'
        return $this->belongsTo(User::class, 'door_number', 'door_number');
    }
}
