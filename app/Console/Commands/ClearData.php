<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'capacitacion:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para limpiar el proyecto';

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
       \Artisan::call('cache:clear');
       $this->info('cache vaciada');
       \Artisan::call('view:clear');
       $this->info('vistas de storare eliminadas');
        \Artisan::call('telescope:clear');
        $this->info('entradas telescope eliminadas');
        \Artisan::call('queue:clear');
        $this->info('colas limpiadas');
    }
}
