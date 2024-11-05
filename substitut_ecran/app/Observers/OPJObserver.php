<?php

namespace App\Observers;

use Illuminate\Support\Facades\DB;
use App\Models\OPJ;

class OPJObserver
{
    public function deleted(OPJ $opj)
    {
        DB::statement('ALTER TABLE opj AUTO_INCREMENT = 1');
    }
}
