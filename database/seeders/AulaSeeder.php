<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aula; // <-- Importe o Model

class AulaSeeder extends Seeder
{
    public function run(): void
    {
        // Limpa a tabela antes de inserir (opcional)
        Aula::truncate();

        Aula::create([
            'titulo' => 'Aula 1: A Crise Hídrica Global e a Urgência da Sustentabilidade',
            'descricao_html' => '<p>Primeira aula do curso, focada em contextualizar a escassez de água no planeta, os principais desafios e por que o uso sustentável é vital para o futuro.</p>',
            'video_embed_url' => 'https://www.youtube.com/embed/SEU_7n94E5A', // Pegue o link de "Incorporar"
            'ordem' => 1,
        ]);

        Aula::create([
            'titulo' => 'Aula 2: Reúso de Água na Prática',
            'descricao_html' => '<p>Segunda aula do curso, focada em explorar métodos e tecnologias para o reuso de água em diferentes escalas (doméstica, industrial e agrícola).</p>',
            'video_embed_url' => 'https://www.youtube.com/embed/SEU_7n94E5A', // Mude para outro vídeo
            'ordem' => 2,
        ]);

        Aula::create([
            'titulo' => 'Aula 3: O Ciclo da Água e a Proteção de Mananciais',
            'descricao_html' => '<p>erceira aula do curso, focada em entender o ciclo hidrológico e a importância vital de conservar rios, lagos e nascentes para garantir a qualidade e quantidade da água.</p>',
            'video_embed_url' => 'https://www.youtube.com/embed/SEU_7n94E5A', // Mude para outro vídeo
            'ordem' => 3,
        ]);

        Aula::create([
            'titulo' => 'Aula 4: Uso Eficiente da Água em Residências ',
            'descricao_html' => '<p>Quarta aula do curso, focada em hábitos, equipamentos economizadores e técnicas práticas para reduzir drasticamente o consumo de água em casa.</p>',
            'video_embed_url' => 'https://www.youtube.com/embed/SEU_7n94E5A', // Mude para outro vídeo
            'ordem' => 4,
        ]);

        Aula::create([
            'titulo' => 'Aula 5: Agricultura Sustentável: Irrigação Inteligente',
            'descricao_html' => '<p>Quinta aula do curso, focada em analisar o impacto da agricultura (maior consumidora de água) e apresentar soluções como gotejamento, microaspersão e hidroponia</p>',
            'video_embed_url' => 'https://www.youtube.com/embed/SEU_7n94E5A', // Mude para outro vídeo
            'ordem' => 5,
        ]);

        Aula::create([
            'titulo' => 'Aula 6: Gestão Hídrica na Indústria e Processos de Recirculação',
            'descricao_html' => '<p>Sexta aula do curso, focada em como as indústrias podem otimizar processos, tratar seus efluentes e implementar sistemas de reuso e recirculação de água.</p>',
            'video_embed_url' => 'https://www.youtube.com/embed/SEU_7n94E5A', // Mude para outro vídeo
            'ordem' => 6,
        ]);

        Aula::create([
            'titulo' => 'Aula 7: Captação e Aproveitamento de Água da Chuva',
            'descricao_html' => '<p>Sétima aula do curso, focada em projetar e implementar sistemas de cisternas e reservatórios para coletar água pluvial para usos não potáveis</p>',
            'video_embed_url' => 'https://www.youtube.com/embed/SEU_7n94E5A', // Mude para outro vídeo
            'ordem' => 7,
        ]);

        Aula::create([
            'titulo' => 'Aula 8: Águas Cinzas: Conceito, Tratamento e Utilização',
            'descricao_html' => '<p>Oitava aula do curso, focada em diferenciar águas cinzas (pias, chuveiros) de águas negras e como tratá-las de forma simples para reuso em descargas e irrigação.</p>',
            'video_embed_url' => 'https://www.youtube.com/embed/SEU_7n94E5A', // Mude para outro vídeo
            'ordem' => 8,
        ]);

        Aula::create([
            'titulo' => 'Aula 9: Poluição Hídrica e Tratamento de Efluentes',
            'descricao_html' => '<p>Nona aula do curso, focada nos tipos de poluentes (químicos, biológicos) e nas etapas do tratamento de esgoto para devolver a água limpa ao meio ambiente.</p>',
            'video_embed_url' => 'https://www.youtube.com/embed/SEU_7n94E5A', // Mude para outro vídeo
            'ordem' => 9,
        ]);

        Aula::create([
            'titulo' => 'Aula 10: Pegada Hídrica e Água Virtual',
            'descricao_html' => '<p>Décima aula do curso, focada em calcular a quantidade de água "escondida" na produção de alimentos, roupas e outros produtos, e o impacto do comércio global.</p>',
            'video_embed_url' => 'https://www.youtube.com/embed/SEU_7n94E5A', // Mude para outro vídeo
            'ordem' => 10,
        ]);
    }
}