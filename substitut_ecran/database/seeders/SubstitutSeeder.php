<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Substitut;

class SubstitutSeeder extends Seeder
{
    public function run()
    {
        // Insérer des données pour les substituts
        Substitut::create(['numero' => 1, 'porte' => 1]);
        Substitut::create(['numero' => 2, 'porte' => 2]);
        Substitut::create(['numero' => 3, 'porte' => 3]);
        Substitut::create(['numero' => 4, 'porte' => 4]);
        Substitut::create(['numero' => 5, 'porte' => 5]);
        Substitut::create(['numero' => 6, 'porte' => 6]);
        Substitut::create(['numero' => 7, 'porte' => 7]);
        Substitut::create(['numero' => 8, 'porte' => 8]);
        Substitut::create(['numero' => 9, 'porte' => 9]);
        Substitut::create(['numero' => 10, 'porte' => 10]);
        Substitut::create(['numero' => 11, 'porte' => 11]);
        Substitut::create(['numero' => 12, 'porte' => 12]);
        
    }
}
