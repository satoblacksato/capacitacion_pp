<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Silber\Bouncer\Database\Role;
use Bouncer;
class AsignaRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'capacitacion:asigna-role {email} {role}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando que asigna roles y permisos en el sistema mediante consola';

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
        $email=$this->argument('email');
        $roleName=$this->argument('role');

        $user=User::where('email','=',strtolower(trim($email)))->first();
        if($user==null){
            $this->error('Email no se encuentra asociado a ningun usuario');
        }

        $role=Role::where('name','=',strtolower(trim($roleName)))->first();
        if($role==null){
            //$this->error('Role no encontrado');
            if($this->confirm('Quieres crear el rol: '.$roleName)){
                $role = Bouncer::role()->firstOrCreate([
                    'name' => $roleName,
                    'title' => $roleName,
                ]);
            }else{
                $this->error('Proceso cancelado al no existir rol');
            }
        }

        $this->info('Se trabajará con usuario: '.$user->name.' y el rol: '.$roleName);

        Bouncer::assign($roleName)->to($user);
        $this->info('rol asignado al usuario');

        $abilities=$this->ask('Ingresa las habilidades separadas por coma: ');
        if($abilities==null){
            $this->error('Proceso cancelado al no existir habilidades');
        }

        $arrAbilities=explode(",",$abilities);
        Bouncer::allow($roleName)->to($arrAbilities);
        $this->info('Permisos Asignados correctamente');

    }
}
