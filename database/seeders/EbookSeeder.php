<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ebook;
use Illuminate\Support\Str;

class EbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allEbooksData = [
            [
                'title' => 'Guia Rápido da Sustentabilidade Hídrica',
                'description' => 'Um breve guia sobre a importância da água e como preservá-la em nosso dia a dia.',
                'cover_path' => 'img/covers/guia-rapido-sustentabilidade-hidrica.png',
                'pages' => [
                    '<h2>Página 1: Bem-vindo</h2><p class="lead">Bem-vindo(a) ao seu guia de Educação Ambiental! Neste mini e-book, exploraremos os fundamentos da gestão hídrica e por que cada gota conta para o nosso futuro.</p>',
                    '<h2>Página 2: O Ciclo Urbano da Água</h2><p>Entenda o caminho que a água faz: captação, tratamento, distribuição, uso e retorno ao ambiente. Conhecer o ciclo ajuda a identificar pontos de desperdício.</p><ul><li>Captação e Tratamento;</li><li>Distribuição e Uso;</li><li>Descarte consciente.</li></ul>',
                    '<h2>Página 3: Redução do Desperdício em Casa</h2><p>Uma torneira pingando pode desperdiçar litros por dia. Identificar pequenos vazamentos reduz o consumo imediato.</p><ul><li>Substitua torneiras antigas;</li><li>Conserte vazamentos rápido;</li><li>Feche a torneira ao escovar os dentes.</li></ul>',
                    '<h2>Página 4: Ações Coletivas</h2><p>Participar de mutirões de limpeza de rios ou projetos de reflorestamento são formas diretas de contribuir. Engaje escolas, associações e vizinhança — o impacto cresce quando a ação é coletiva.</p>',
                    '<h2>Página 5: Reuso Simples</h2><p>Coletar água da chuva e reaproveitar a água da máquina de lavar para lavar o quintal são práticas eficazes.</p><ul><li>Instale cisternas;</li><li>Use baldes ao lavar o carro;</li><li>Evite produtos químicos na água de reuso.</li></ul>',
                    '<h2>Página 6: Seu Compromisso</h2><p>A crise hídrica é real, mas pode ser mitigada. Crie um plano: identificar desperdícios, agir em casa e compartilhar conhecimento. Obrigado por fazer parte da mudança.</p>'
                ]
            ],
            [
                'title' => 'Os 6 R\'s da Sustentabilidade',
                'description' => 'Repense, Recuse, Reduza, Reutilize, Recicle e Repare. O guia completo para um consumo consciente.',
                'cover_path' => 'img/covers/os-6-rs-da-sustentabilidade.png',
                'pages' => [
                    '<h2>Página 1: Repense e Recuse</h2><p>Repensar é a etapa de avaliar a real necessidade de consumo. Antes de comprar, pergunte-se: "Eu realmente preciso disso?".</p><p>Recusar embalagens desnecessárias reduz significativamente o volume de resíduos.</p>',
                    '<h2>Página 2: Reduza</h2><p>Reduzir é sobre diminuir a quantidade de produtos e embalagens que compramos.</p><ul><li>Opte por produtos sem embalagens ou com menos plástico;</li><li>Escolha itens em embalagens recicláveis;</li><li>Prefira produtos duráveis.</li></ul>',
                    '<h2>Página 3: Reutilize</h2><p>Reutilizar é prolongar o tempo de vida dos objetos: transforme potes, frascos e roupas em itens úteis novamente.</p><p>Boas práticas: consertar, adaptar e reaproveitar embalagens para armazenamento.</p>',
                    '<h2>Página 4: Recicle</h2><p>Separar corretamente os resíduos facilita a reciclagem e reduz a quantidade de lixo enviada para aterros.</p><p>Verifique os programas locais de coleta seletiva e participe ativamente.</p>',
                    '<h2>Página 5: Repare</h2><p>Consertar produtos antes de descartá-los prolonga seu uso e economiza materiais e energia.</p><p>Procure serviços de conserto locais e aprenda pequenas manutenções em casa.</p>',
                    '<h2>Página 6: Metas Pessoais</h2><p>Defina metas práticas: reduzir consumo de água e energia, recusar sacolas plásticas e comprar produtos locais.</p><p>Documente seus progressos e compartilhe com amigos.</p>'
                ]
            ],
            [
                'title' => 'Biodiversidade e Água Doce',
                'description' => 'A relação essencial entre ecossistemas saudáveis e a disponibilidade de água para o consumo humano.',
                'cover_path' => 'img/covers/biodiversidade-e-agua-doce.png',
                'pages' => [
                    '<h2>Página 1: Ecossistemas Hídricos</h2><p>Rios, lagos e pântanos abrigam diversidade e funcionam como filtros naturais que retêm sedimentos e purificam a água.</p><p>Preservar esses ecossistemas é garantir fornecimento de água.</p>',
                    '<h2>Página 2: A Importância das Matas Ciliares</h2><p>As matas ciliares reduzem erosão, filtram poluentes e oferecem habitat a espécies importantes.</p><p>Manter faixas de vegetação ao redor de corpos d\'água é essencial.</p>',
                    '<h2>Página 3: Serviços Ecossistêmicos</h2><p>Os serviços ambientais fornecem água limpa, regulação das cheias e suporte à biodiversidade.</p><p>Valorizá-los significa apoiar práticas agrícolas e urbanas sustentáveis.</p>',
                    '<h2>Página 4: Fauna Aquática</h2><p>Peixes, anfíbios e macroinvertebrados são indicadores do estado de saúde do ecossistema.</p><p>Monitorar espécies ajuda a identificar impactos e a direcionar ações.</p>',
                    '<h2>Página 5: Ameaças</h2><p>Descargas industriais, uso de agrotóxicos e obras sem planejamento comprometem a qualidade da água.</p><p>Reduzir poluentes é prioridade para conservar a vida aquática.</p>',
                    '<h2>Página 6: O Caminho da Proteção</h2><p>Educação ambiental, reflorestamento e políticas públicas efetivas são essenciais.</p><p>Participe de iniciativas locais e promova práticas de baixo impacto em sua comunidade.</p>'
                ]
            ],
            [
                'title' => 'Monitoramento da Qualidade da Água',
                'description' => 'Métodos simples e avançados para avaliar se a água é segura para o consumo e para a vida aquática.',
                'cover_path' => 'img/covers/monitoramento-da-qualidade-da-agua.png',
                'pages' => [
                    '<h2>Página 1: Parâmetros Essenciais</h2><p>pH, oxigênio dissolvido, condutividade, turbidez e coliformes são parâmetros chaves para avaliar a água.</p><p>Conheça os intervalos típicos e o que cada parâmetro significa.</p>',
                    '<h2>Página 2: Testes de Campo</h2><p>Testes de campo rápidos podem indicar problemas: kits de pH, medidores de oxigênio dissolvido e turbidímetros portáteis são úteis.</p><p>Combine observações visuais com testes.</p>',
                    '<h2>Página 3: Análise Laboratorial</h2><p>Para detectar metais e pesticidas, amostras devem ser analisadas em laboratórios certificados.</p><p>Planeje a coleta corretamente para evitar contaminação.</p>',
                    '<h2>Página 4: Bioindicadores</h2><p>Macroinvertebrados e peixes possuem níveis de tolerância à poluição: algumas espécies são sensíveis e sinalizam ambientes saudáveis.</p><p>Use guias locais para identificar espécies.</p>',
                    '<h2>Página 5: O Padrão de Potabilidade</h2><p>Entenda os limites de potabilidade para parâmetros como coliformes e metais pesados. Eles garantem a segurança da água de consumo.</p><p>Ações rápidas são necessárias quando limites são excedidos.</p>',
                    '<h2>Página 6: Relatório Cidadão</h2><p>Como cidadãos, podemos solicitar relatórios de qualidade da água e promover fiscalizações. Informe-se sobre os órgãos responsáveis em sua região.</p>'
                ]
            ],
            [
                'title' => 'Água e Clima: A Conexão Vital',
                'description' => 'Como as mudanças climáticas afetam o ciclo hidrológico e o que isso significa para o abastecimento.',
                'cover_path' => 'img/covers/agua-e-clima-a-conexao-vital.png',
                'pages' => [
                    '<h2>Página 1: Aquecimento Global e Chuvas</h2><p>O aumento da temperatura intensifica a evaporação e altera os padrões de chuvas, com eventos extremos mais frequentes.</p><p>O planejamento urbano precisa considerar isso.</p>',
                    '<h2>Página 2: Degelo</h2><p>O degelo de geleiras compromete fontes de água doce para milhões de pessoas. Regiões dependentes dessas reservas devem buscar adaptação.</p>',
                    '<h2>Página 3: Impacto na Agricultura</h2><p>Safras sensíveis às chuvas serão afetadas; técnicas como manejo de solo e irrigação eficiente ajudam a reduzir vulnerabilidade.</p>',
                    '<h2>Página 4: Desertificação</h2><p>O uso inadequado do solo e a perda de cobertura vegetal aceleram a desertificação, reduzindo a capacidade de recarga de aquíferos.</p>',
                    '<h2>Página 5: Adaptação</h2><p>Adaptação inclui infraestrutura resiliente, conservação de solos e sistemas de reuso.</p><ul><li>Reservatórios e cisternas;</li><li>Irrigação eficiente;</li><li>Reflorestamento.</li></ul>',
                    '<h2>Página 6: Mitigação</h2><p>Mitigação passa por reduzir emissões de gases de efeito estufa, promover energias renováveis e políticas sustentáveis que preservem ciclos naturais.</p>'
                ]
            ],
            [
                'title' => 'Introdução à Pegada Hídrica',
                'description' => 'Calcule o volume total de água necessário para produzir os bens e serviços que você consome diariamente.',
                'cover_path' => 'img/covers/introducao-a-pegada-hidrica.png',
                'pages' => [
                    '<h2>Página 1: O Que é Pegada Hídrica?</h2><p>É o volume total de água doce usada para produzir bens e serviços consumidos por um indivíduo, comunidade ou empresa.</p>',
                    '<h2>Página 2: Água Virtual</h2><p>Água virtual refere-se à água incorporada em alimentos e produtos. Exemplo: fabricar um quilo de arroz usa água na irrigação e processamento.</p>',
                    '<h2>Página 3: Exemplos Práticos</h2><p>Alguns valores médios: 1 kg de carne bovina ~15.000 L; 1 xícara de café ~140 L. Escolhas alimentares influenciam a pegada.</p>',
                    '<h2>Página 4: Tipos de Pegada Hídrica</h2><p>Azul, Verde e Cinza representam fontes e impactos da água. Compreender essas categorias ajuda a reduzir seu impacto.</p>',
                    '<h2>Página 5: Como Reduzir sua Pegada</h2><p>Mudar hábitos alimentares, evitar desperdício e preferir produtos locais.</p><ul><li>Prefira alimentos com menor demanda hídrica;</li><li>Reduza desperdício;</li><li>Procure marcas transparentes.</li></ul>',
                    '<h2>Página 6: Ferramentas de Cálculo</h2><p>Calculadoras de pegada hídrica ajudam a estimar seu impacto e sugerir ações. Registre seus alimentos e hábitos para entender seu perfil hídrico.</p>'
                ]
            ]
        ];

        Ebook::query()->delete();

        foreach ($allEbooksData as $data) {
            $ebook = Ebook::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'cover_path' => $data['cover_path'],
                'short_description' => $data['description'],
            ]);

            for ($i = 0; $i < 6; $i++) {
                $content = $data['pages'][$i] ?? "<h2>Página " . ($i + 1) . "</h2><p>Conteúdo em desenvolvimento.</p>";
                $ebook->pages()->create([
                    'page_number' => $i + 1,
                    'content' => $content,
                ]);
            }
        }
    }
}