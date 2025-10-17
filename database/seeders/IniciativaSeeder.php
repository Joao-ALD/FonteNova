<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IniciativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Apaga dados antigos para evitar duplicatas ao rodar o seeder de novo
        DB::table('iniciativas')->truncate();

        DB::table('iniciativas')->insert([
            [
                'estado_sigla' => 'SP',
                'titulo' => 'Restauração do Rio Tietê',
                'descricao' => 'Projeto contínuo para a despoluição do principal rio paulista.'
            ],
            [
                'estado_sigla' => 'AM',
                'titulo' => 'Guardiões da Floresta',
                'descricao' => 'Programa de manejo sustentável dos recursos hídricos com comunidades ribeirinhas.'
            ],
            [
                'estado_sigla' => 'CE',
                'titulo' => 'Programa Cisternas',
                'descricao' => 'Construção de cisternas para garantir o acesso à água no semiárido cearense.'
            ],
            // Adicione aqui quantos outros estados você quiser...
        ]);
    }
}
