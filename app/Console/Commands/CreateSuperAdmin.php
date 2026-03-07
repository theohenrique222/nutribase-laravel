<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-super-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name       = $this->ask('Insira o nome do usuario');
        $email      = $this->ask('Insira o E-mail');
        $password   = $this->secret('Insira a senha');


        User::create([
            'name'      => $name,
            'email'     => $email,
            'password'  => Hash::make($password),
        ]);

        $this->info('Usuário admin cadastrado com sucesso!');
    }
}
