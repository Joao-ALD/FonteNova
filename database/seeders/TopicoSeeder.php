<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topico;

class TopicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topico::create([
            'titulo' => 'Reutilização da Água da Chuva',
            'palavras_chave' => 'chuva,agua da chuva,reutilizar,cisterna,captacao,armazenar',
            'resumo' => 'Aprenda como coletar, armazenar e reutilizar água da chuva para fins domésticos.',
            'link_site' => '/reutilizacao-agua-chuva',
            'link_premium' => '/premium/reutilizacao-agua'
        ]);

        Topico::create([
            'titulo' => 'Economia na Conta de Água',
            'palavras_chave' => 'conta de agua,economizar,reducao,gastos,vazamento,consumo',
            'resumo' => 'Dicas práticas para reduzir o consumo e economizar na conta de água.',
            'link_site' => '/economia-agua',
            'link_premium' => null
        ]);

        Topico::create([
            'titulo' => 'Preservação de Rios e Mananciais',
            'palavras_chave' => 'rios,mananciais,preservar,natureza,descarte,poluicao',
            'resumo' => 'Entenda como suas ações ajudam na preservação de rios e nascentes.',
            'link_site' => '/preservacao-hidrica',
            'link_premium' => '/premium/preservacao'
        ]);

        Topico::create([
            'titulo' => 'Educação para o Uso Sustentável da Água',
            'palavras_chave' => 'educacao,sustentabilidade,uso consciente,escolas,crianças',
            'resumo' => 'Saiba como promover a educação ambiental focada no uso consciente da água.',
            'link_site' => '/educacao-agua',
            'link_premium' => null
        ]);

        Topico::create([
            'titulo' => 'Métodos de Economia de Água no Dia a Dia',
            'palavras_chave' => 'economia,banho,torneira,descarga,chuveiro,tomar banho,lavar roupa',
            'resumo' => 'Conheça métodos simples que ajudam a economizar água todos os dias.',
            'link_site' => '/metodos-economia-agua',
            'link_premium' => '/premium/metodos-economia'
        ]);
    }
}
