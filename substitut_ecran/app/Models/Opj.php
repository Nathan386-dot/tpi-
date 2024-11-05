<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opj extends Model
{
    protected $table = 'opj';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['provenance', 'role', 'numero_appel'];
}
