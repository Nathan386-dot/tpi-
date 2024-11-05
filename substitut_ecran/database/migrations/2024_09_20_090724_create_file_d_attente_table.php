<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileDAttenteTable extends Migration
{
    public function up()
    {
        Schema::create('file_d_attente', function (Blueprint $table) {
            $table->id();
            $table->string('provenance');
            $table->string('role');
            $table->integer('num_substitut'); // Numéro du substitut
            $table->string('numero_appel'); // Numéro d'appel de l'OPJ
            $table->timestamps(); // Si vous utilisez des timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_d_attente');
    }
}
