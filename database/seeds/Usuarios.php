<?php

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class Usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Usuario::create([
            'nome' => str_random(10),
            'login' => str_random(10),
            'senha' => bcrypt('secret'),
            'assinante' => true,
        ]);

        Usuario::create([
            'nome' => str_random(10),
            'login' => str_random(10),
            'senha' => bcrypt('secret'),
            'assinante' => false,
        ]);
    }
}
