<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estado;
use App\Models\Iniciativa;

class IniciativaRealSeeder extends Seeder
{
    public function run()
    {
        $iniciativasReais = [
            'SP' => [
                [
                    'titulo' => 'Sistema Cantareira',
                    'descricao' => 'Maior sistema de abastecimento de água da RMSP, responsável por fornecer água para mais de 7 milhões de pessoas.',
                    'tipo' => 'água',
                    'status' => 'em_andamento',
                    'investimento' => 2500000000,
                    'link_externo' => 'https://www.sabesp.com.br/cantareira'
                ],
                [
                    'titulo' => 'Programa Córrego Limpo',
                    'descricao' => 'Iniciativa para despoluição de córregos urbanos na cidade de São Paulo através de obras de saneamento.',
                    'tipo' => 'saneamento',
                    'status' => 'em_andamento',
                    'investimento' => 800000000,
                    'link_externo' => 'https://www.prefeitura.sp.gov.br/cidade/secretarias/meio_ambiente/programas/index.php?p=3428'
                ]
            ],
            'RJ' => [
                [
                    'titulo' => 'Programa Baía de Guanabara',
                    'descricao' => 'Projeto de despoluição da Baía de Guanabara com tratamento de esgoto e recuperação ambiental.',
                    'tipo' => 'saneamento',
                    'status' => 'em_andamento',
                    'investimento' => 1200000000,
                    'link_externo' => 'https://www.inea.rj.gov.br/cs/groups/public/documents/document/zwew/mdi0/~edisp/inea0024002.pdf'
                ],
                [
                    'titulo' => 'Reflorestamento da Tijuca',
                    'descricao' => 'Maior projeto de reflorestamento urbano do mundo, recuperando a Floresta da Tijuca.',
                    'tipo' => 'conservação',
                    'status' => 'concluído',
                    'investimento' => 50000000,
                    'link_externo' => 'https://www.icmbio.gov.br/parnatijuca/'
                ]
            ],
            'MG' => [
                [
                    'titulo' => 'Revitalização do Rio São Francisco',
                    'descricao' => 'Programa de recuperação das nascentes e mata ciliar do Rio São Francisco em Minas Gerais.',
                    'tipo' => 'conservação',
                    'status' => 'em_andamento',
                    'investimento' => 900000000,
                    'link_externo' => 'https://www.cbhsaofrancisco.org.br/'
                ],
                [
                    'titulo' => 'Programa Minas Trata Esgoto',
                    'descricao' => 'Ampliação do tratamento de esgoto em municípios mineiros para proteção dos recursos hídricos.',
                    'tipo' => 'saneamento',
                    'status' => 'em_andamento',
                    'investimento' => 1500000000,
                    'link_externo' => 'https://www.copasa.com.br/wps/portal/internet/imprensa/noticias'
                ]
            ],
            'AM' => [
                [
                    'titulo' => 'Programa Amazônia Sustentável',
                    'descricao' => 'Conservação de recursos hídricos e biodiversidade na região amazônica.',
                    'tipo' => 'conservação',
                    'status' => 'em_andamento',
                    'investimento' => 2000000000,
                    'link_externo' => 'https://www.gov.br/mma/pt-br/assuntos/ecossistemas-1/biomas/amazonia'
                ]
            ],
            'CE' => [
                [
                    'titulo' => 'Programa Água Doce',
                    'descricao' => 'Dessalinização de água para comunidades rurais do semiárido cearense.',
                    'tipo' => 'água',
                    'status' => 'em_andamento',
                    'investimento' => 300000000,
                    'link_externo' => 'https://www.gov.br/mdr/pt-br/assuntos/seguranca-hidrica/programa-agua-doce'
                ]
            ],
            'RS' => [
                [
                    'titulo' => 'Proteção dos Banhados',
                    'descricao' => 'Conservação de áreas úmidas no Rio Grande do Sul para preservação da biodiversidade.',
                    'tipo' => 'conservação',
                    'status' => 'em_andamento',
                    'investimento' => 150000000,
                    'link_externo' => 'https://www.sema.rs.gov.br/'
                ]
            ]
        ];

        foreach ($iniciativasReais as $sigla => $iniciativas) {
            $estado = Estado::where('sigla', $sigla)->first();
            if ($estado) {
                foreach ($iniciativas as $iniciativa) {
                    Iniciativa::create([
                        'estado_id' => $estado->id,
                        'titulo' => $iniciativa['titulo'],
                        'descricao' => $iniciativa['descricao'],
                        'tipo' => $iniciativa['tipo'],
                        'status' => $iniciativa['status'],
                        'investimento' => $iniciativa['investimento'],
                        'latitude' => -15.7942 + (rand(-1000, 1000) / 100),
                        'longitude' => -47.8822 + (rand(-1000, 1000) / 100),
                        'link_externo' => $iniciativa['link_externo'] ?? null,
                    ]);
                }
            }
        }
    }
}