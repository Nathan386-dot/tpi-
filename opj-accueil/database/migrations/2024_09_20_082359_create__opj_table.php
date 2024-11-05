<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpjTable extends Migration
{
    public function up()
    {
        Schema::create('opj', function (Blueprint $table) {
            $table->id(); // ID auto-incrémenté
            $table->string('provenance'); // Provenance
            $table->string('role'); // Rôle (policier, gendarme, inspecteur)
            $table->unsignedBigInteger('numero_appel'); // Numéro d'appel en BIGINT UNSIGNED
            $table->boolean('prise_en_charge')->nullable()->default(null); // Indique si l'OPJ a été pris en charge ou non
            $table->unsignedBigInteger('door_number')->nullable(); // Numéro de porte attribué au substitut
            $table->boolean('is_taken')->default(false); // Indique si l'OPJ a été pris en charge (false par défaut)
            $table->timestamps(); // Champs created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('opj');
    }
}
