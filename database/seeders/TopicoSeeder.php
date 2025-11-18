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
            'palavras_chave' => 'chuva,agua da chuva,reutilizar,cisterna,captacao,armazenar,coleta',
            'resumo' => 'A captação de água da chuva é uma prática sustentável que pode reduzir até 50% do consumo de água potável em residências. Instale calhas e cisternas para coletar a água do telhado. Use essa água para regar plantas, lavar pisos, carros e até em descargas. Um sistema básico pode ser instalado com baixo custo e gera economia imediata na conta de água.',
            'link_site' => '/infoAgua#collapseColeta',
            'link_premium' => '/galeria'
        ]);

        Topico::create([
            'titulo' => 'Economia na Conta de Água',
            'palavras_chave' => 'conta de agua,economizar,reducao,gastos,vazamento,consumo,diminuir',
            'resumo' => 'Pequenas mudanças geram grande economia: feche a torneira ao escovar os dentes (economiza 12 litros/dia), tome banhos de 5 minutos (economia de 80 litros), conserte vazamentos imediatamente (uma torneira pingando desperdiça 46 litros/dia), use máquina de lavar apenas com carga completa e instale redutores de vazão nas torneiras. Essas ações podem reduzir sua conta em até 40%.',
            'link_site' => '/infoAgua#collapseConsumo',
            'link_premium' => null
        ]);

        Topico::create([
            'titulo' => 'Preservação de Rios e Mananciais',
            'palavras_chave' => 'rios,mananciais,preservar,natureza,descarte,poluicao,nascentes,meio ambiente',
            'resumo' => 'Os rios e mananciais são fontes vitais de água doce. Preserve-os evitando jogar lixo, óleo ou produtos químicos no ralo ou em corpos d\'água. Participe de projetos de reflorestamento de matas ciliares, que protegem as margens dos rios. Denuncie poluição e desmatamento às autoridades ambientais. Cada ação individual contribui para garantir água limpa para as futuras gerações.',
            'link_site' => '/infoAgua#collapsePreservacao',
            'link_premium' => '/sobre'
        ]);

        Topico::create([
            'titulo' => 'Educação para o Uso Sustentável da Água',
            'palavras_chave' => 'educacao,sustentavel,sustentabilidade,uso consciente,escolas,criancas,ensino,aprender,ambiental',
            'resumo' => 'A educação ambiental é fundamental para formar cidadãos conscientes. Ensine crianças sobre o ciclo da água, a importância da preservação e práticas de economia. Promova atividades práticas como hortas escolares com irrigação eficiente, visitas a estações de tratamento e projetos de reciclagem. Escolas e famílias devem trabalhar juntas para criar uma cultura de respeito e cuidado com os recursos hídricos.',
            'link_site' => '/sobre',
            'link_premium' => null
        ]);

        Topico::create([
            'titulo' => 'Métodos de Economia de Água no Dia a Dia',
            'palavras_chave' => 'economia,banho,torneira,descarga,chuveiro,tomar banho,lavar roupa,metodos,dicas',
            'resumo' => 'Adote hábitos simples: reutilize a água da máquina de lavar para limpar áreas externas, colete a água fria do chuveiro enquanto esquenta para regar plantas, lave louças em uma bacia ao invés de água corrente, varra calçadas ao invés de lavá-las com mangueira, e use balde para lavar o carro (economia de 216 litros). Instale torneiras com aerador e vasos sanitários com duplo acionamento.',
            'link_site' => '/infoAgua#collapseConsumo',
            'link_premium' => '/galeria'
        ]);

        Topico::create([
            'titulo' => 'Impactos das Mudanças Climáticas na Água',
            'palavras_chave' => 'clima,mudancas climaticas,aquecimento global,seca,escassez,temperatura',
            'resumo' => 'As mudanças climáticas estão alterando o ciclo hidrológico global, causando secas prolongadas em algumas regiões e enchentes em outras. O aumento da temperatura acelera a evaporação, reduzindo a disponibilidade de água doce. Geleiras que abastecem rios estão derretendo rapidamente. É urgente reduzir emissões de carbono, proteger ecossistemas aquáticos e desenvolver tecnologias de uso eficiente da água para enfrentar essa crise.',
            'link_site' => '/infoAgua#collapseClima',
            'link_premium' => '/mapa'
        ]);

        Topico::create([
            'titulo' => 'Tratamento e Qualidade da Água',
            'palavras_chave' => 'tratamento,qualidade,potavel,filtro,purificacao,limpa,saneamento',
            'resumo' => 'O tratamento de água remove impurezas, bactérias e vírus, tornando-a segura para consumo. O processo inclui coagulação, floculação, decantação, filtração e desinfecção com cloro. Em casa, use filtros certificados e mantenha caixas d\'água limpas e tampadas. Água de qualidade previne doenças e é essencial para a saúde. Apoie investimentos em saneamento básico e tratamento de esgoto em sua comunidade.',
            'link_site' => '/infoAgua#collapseColeta',
            'link_premium' => null
        ]);

        Topico::create([
            'titulo' => 'Reuso de Água Cinza',
            'palavras_chave' => 'reuso,agua cinza,reciclagem,reutilizar,chuveiro,pia,lavanderia',
            'resumo' => 'Água cinza é a água usada em pias, chuveiros e máquinas de lavar (exceto vaso sanitário). Com tratamento simples, pode ser reutilizada para irrigação, descarga e limpeza. Sistemas residenciais de reuso podem economizar até 30% do consumo total. Use sabões biodegradáveis para facilitar o reuso. É uma solução sustentável que reduz a demanda por água potável e diminui o volume de esgoto.',
            'link_site' => '/infoAgua#collapseColeta',
            'link_premium' => '/galeria'
        ]);
    }
}
