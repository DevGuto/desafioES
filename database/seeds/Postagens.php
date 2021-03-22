<?php

use Illuminate\Database\Seeder;
use App\Models\Postagem;

class Postagens extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Postagem::create([
            'titulo' => str_random(100),
            'descricao' => str_random(250),
            'usuario_id' => 1,
        ]);

        Postagem::create([
            'titulo' => str_random(100),
            'descricao' => str_random(250),
            'usuario_id' => 2,
        ]);
    }
}
