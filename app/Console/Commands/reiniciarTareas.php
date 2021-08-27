<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tarea;
use Database\Seeders\TareaSeeder;

class reiniciarTareas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tareas:reiniciar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Borra todas las tareas de la base de datos y añade unas por defecto.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (Tarea::truncate()) {
            $seeder = new TareaSeeder();
            $seeder->run();
        }
    }
}
