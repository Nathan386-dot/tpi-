<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opj extends Model
{
    use HasFactory;

    protected $table = 'opj';
    protected $fillable = ['provenance', 'role', 'numero_appel'];
}
