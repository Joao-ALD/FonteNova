<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            ['sigla' => 'AC', 'nome' => 'Acre', 'regiao' => 'Norte', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'AL', 'nome' => 'Alagoas', 'regiao' => 'Nordeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'AP', 'nome' => 'Amapá', 'regiao' => 'Norte', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'AM', 'nome' => 'Amazonas', 'regiao' => 'Norte', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'BA', 'nome' => 'Bahia', 'regiao' => 'Nordeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'CE', 'nome' => 'Ceará', 'regiao' => 'Nordeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'DF', 'nome' => 'Distrito Federal', 'regiao' => 'Centro-Oeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'ES', 'nome' => 'Espírito Santo', 'regiao' => 'Sudeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'GO', 'nome' => 'Goiás', 'regiao' => 'Centro-Oeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'MA', 'nome' => 'Maranhão', 'regiao' => 'Nordeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'MT', 'nome' => 'Mato Grosso', 'regiao' => 'Centro-Oeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'MS', 'nome' => 'Mato Grosso do Sul', 'regiao' => 'Centro-Oeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'MG', 'nome' => 'Minas Gerais', 'regiao' => 'Sudeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'PA', 'nome' => 'Pará', 'regiao' => 'Norte', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'PB', 'nome' => 'Paraíba', 'regiao' => 'Nordeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'PR', 'nome' => 'Paraná', 'regiao' => 'Sul', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'PE', 'nome' => 'Pernambuco', 'regiao' => 'Nordeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'PI', 'nome' => 'Piauí', 'regiao' => 'Nordeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'RJ', 'nome' => 'Rio de Janeiro', 'regiao' => 'Sudeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'RN', 'nome' => 'Rio Grande do Norte', 'regiao' => 'Nordeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'RS', 'nome' => 'Rio Grande do Sul', 'regiao' => 'Sul', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'RO', 'nome' => 'Rondônia', 'regiao' => 'Norte', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'RR', 'nome' => 'Roraima', 'regiao' => 'Norte', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'SC', 'nome' => 'Santa Catarina', 'regiao' => 'Sul', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'SP', 'nome' => 'São Paulo', 'regiao' => 'Sudeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'SE', 'nome' => 'Sergipe', 'regiao' => 'Nordeste', 'dados_geograficos' => json_encode(['path' => '...'])],
            ['sigla' => 'TO', 'nome' => 'Tocantins', 'regiao' => 'Norte', 'dados_geograficos' => json_encode(['path' => '...'])],
        ];

        foreach ($estados as $estado) {
            Estado::create($estado);
        }
    }
}
