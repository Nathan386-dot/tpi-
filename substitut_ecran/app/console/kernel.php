<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Les commandes de console disponibles dans votre application.
     *
     * @var array
     */
    protected $commands = [
        // Ajoutez vos commandes Artisan personnalisées ici
    ];

    /**
     * Configurez les commandes de planification de votre application.
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Planifiez vos tâches ici
        // $schedule->call('App\Http\Controllers\YourController@yourMethod')->daily();
    }

    /**
     * Configurez le système de planification pour exécuter des tâches.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
