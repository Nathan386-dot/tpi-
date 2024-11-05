<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('provenances', function (Blueprint $table) {
            $table->string('provenance_name');
            $table->string('provenance_details')->nullable(); // Si ce champ est facultatif
        });
    }
        public function down(): void
    {
        Schema::table('provenances', function (Blueprint $table) {
            //
        });
    }
};
