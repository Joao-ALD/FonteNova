<?php

namespace Database\Seeder;

use Illuminate\Database\Seeder;
use App\Models\Ebook;
use App\Models\EbookPage;
use Illuminate\Support\Str;

class EbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Definição dos 6 E-books
        $allEbooksData = [
            [
                'title' => 'Guia Rápido da Sustentabilidade Hídrica',
                'description' => 'Um breve guia sobre a importância da água e como preservá-la em nosso dia a dia.',
                'cover_color' => '4a90e2', // Azul Claro
                'pages' => [
                    // Página 1 (mantida)
                    '
                        <p class="lead">Bem-vindo(a) ao seu guia de Educação Ambiental!</p>
                        <p>Neste mini e-book, exploraremos os fundamentos da gestão hídrica e por que cada gota conta para o nosso futuro.</p>
                        <p class="text-center mt-5"><i class="fas fa-tint fa-3x text-info"></i></p>
                    ',
                    // Página 2
                    '
                        <h2>O Ciclo Urbano da Água</h2>
                        <p>Entenda o caminho que a água faz: da captação ao tratamento, distribuição, uso e descarte. O ciclo é fundamental para a saúde pública.</p>
                        <p>Conhecer o ciclo ajuda a identificar pontos de desperdício e poluição.</p>
                    ',
                    // Página 3
                    '
                        <h2>Redução do Desperdício em Casa</h2>
                        <p>Uma torneira pingando pode desperdiçar mais de 40 litros por dia. Pequenos vazamentos na descarga são ainda mais graves.</p>
                        <p>Sempre verifique as instalações hidráulicas de sua residência e faça reparos imediatos.</p>
                    ',
                    // Página 4
                    '
                        <h2>Ações Coletivas</h2>
                        <p>Participar de mutirões de limpeza de rios ou projetos de reflorestamento locais são formas diretas de contribuir para a saúde hídrica da sua região.</p>
                        <p>A água é um bem comum, e sua gestão é responsabilidade de todos.</p>
                    ',
                    // Página 5
                    '
                        <h2>Reuso Simples</h2>
                        <p>A água da chuva ou a água usada para lavar vegetais podem ser coletadas e utilizadas para regar plantas, lavar o quintal ou o carro. Isso economiza água tratada.</p>
                        <p>O reuso é uma das práticas mais eficazes de conservação.</p>
                    ',
                    // Página 6
                    '
                        <h2>Seu Compromisso</h2>
                        <p>A crise hídrica é real, mas pode ser mitigada com ações responsáveis e conscientes. Mantenha-se informado e seja um defensor da água limpa e abundante.</p>
                        <p class="text-success mt-4 fw-bold">Fim do Guia.</p>
                    '
                ]
            ],
            [
                'title' => 'Os 6 R\'s da Sustentabilidade',
                'description' => 'Repense, Recuse, Reduza, Reutilize, Recicle e Repare. O guia completo para um consumo consciente.',
                'cover_color' => '1a3b6e', // Azul Escuro
                'pages' => [
                    '<h2>Página 1: Repense e Recuse</h2><p>O primeiro passo é questionar a real necessidade de um produto antes de comprá-lo. Recuse embalagens excessivas e plásticos de uso único.</p>',
                    '<h2>Página 2: Reduza</h2><p>Diminuir o volume de lixo e consumo é a ação mais impactante. Priorize produtos duráveis e de qualidade.</p>',
                    '<h2>Página 3: Reutilize</h2><p>Dê uma nova vida a objetos que seriam descartados. Potes de vidro viram recipientes, e roupas velhas viram panos de limpeza.</p>',
                    '<h2>Página 4: Recicle</h2><p>Quando o item chega ao fim de sua vida útil, separe-o corretamente para que possa ser transformado em matéria-prima.</p>',
                    '<h2>Página 5: Repare</h2><p>Em vez de jogar fora, conserte! O reparo prolonga a vida útil e economiza recursos naturais.</p>',
                    '<h2>Página 6: Metas Pessoais</h2><p>Defina pequenas metas diárias para incorporar os 6 R\'s e observe a diferença no seu impacto ambiental.</p>'
                ]
            ],
            [
                'title' => 'Biodiversidade e Água Doce',
                'description' => 'A relação essencial entre ecossistemas saudáveis e a disponibilidade de água para o consumo humano.',
                'cover_color' => '6c757d', // Cinza
                'pages' => [
                    '<h2>Página 1: Ecossistemas Hídricos</h2><p>Rios, lagos e pântanos abrigam uma vasta biodiversidade e atuam como filtros naturais de água.</p>',
                    '<h2>Página 2: A Importância das Matas Ciliares</h2><p>As florestas ao redor dos rios protegem o solo da erosão e evitam que sedimentos e poluentes cheguem à água.</p>',
                    '<h2>Página 3: Serviços Ecossistêmicos</h2><p>A natureza nos fornece serviços essenciais, como água limpa e regulação climática, gratuitamente. Precisamos protegê-la.</p>',
                    '<h2>Página 4: Fauna Aquática</h2><p>Muitas espécies de peixes e anfíbios são indicadores da qualidade da água. Sua presença ou ausência nos diz muito sobre a saúde de um rio.</p>',
                    '<h2>Página 5: Ameaças</h2><p>Poluição industrial, agrotóxicos e construção desordenada são as principais ameaças à vida aquática e à nossa água potável.</p>',
                    '<h2>Página 6: O Caminho da Proteção</h2><p>Invista em educação e apoie políticas de conservação para garantir um futuro com água e vida selvagem abundantes.</p>'
                ]
            ],
            [
                'title' => 'Monitoramento da Qualidade da Água',
                'description' => 'Métodos simples e avançados para avaliar se a água é segura para o consumo e para a vida aquática.',
                'cover_color' => '28a745', // Verde
                'pages' => [
                    '<h2>Página 1: Parâmetros Essenciais</h2><p>Os principais indicadores de qualidade são pH, oxigênio dissolvido, turbidez e presença de coliformes fecais.</p>',
                    '<h2>Página 2: Testes de Campo</h2><p>Muitos kits simples permitem medir o pH e a temperatura da água com facilidade, dando um panorama inicial.</p>',
                    '<h2>Página 3: Análise Laboratorial</h2><p>Para resultados precisos e detecção de poluentes químicos, amostras devem ser enviadas a laboratórios especializados.</p>',
                    '<h2>Página 4: Bioindicadores</h2><p>A presença de certos insetos e pequenos organismos aquáticos pode indicar o nível de poluição da água.</p>',
                    '<h2>Página 5: O Padrão de Potabilidade</h2><p>A legislação brasileira estabelece limites rigorosos para garantir que a água fornecida seja segura para beber.</p>',
                    '<h2>Página 6: Relatório Cidadão</h2><p>Aprenda a ler relatórios de qualidade da água e a questionar órgãos responsáveis quando necessário.</p>'
                ]
            ],
            [
                'title' => 'Água e Clima: A Conexão Vital',
                'description' => 'Como as mudanças climáticas afetam o ciclo hidrológico e o que isso significa para o abastecimento.',
                'cover_color' => 'ffc107', // Amarelo
                'pages' => [
                    '<h2>Página 1: Aquecimento Global e Chuvas</h2><p>O aumento da temperatura intensifica a evaporação, alterando padrões de chuva e causando secas mais longas e inundações mais violentas.</p>',
                    '<h2>Página 2: Degelo</h2><p>O derretimento de geleiras e calotas polares ameaça o fornecimento de água doce em regiões que dependem dessa fonte.</p>',
                    '<h2>Página 3: Impacto na Agricultura</h2><p>A irregularidade das chuvas compromete safras, exigindo maior irrigação e pressionando ainda mais os mananciais.</p>',
                    '<h2>Página 4: Desertificação</h2><p>O manejo incorreto do solo, somado às mudanças climáticas, transforma áreas férteis em desertos, esgotando recursos hídricos superficiais.</p>',
                    '<h2>Página 5: Adaptação</h2><p>Precisamos de infraestrutura hídrica resiliente, como reservatórios e sistemas de reuso, para nos adaptar ao novo cenário climático.</p>',
                    '<h2>Página 6: Mitigação</h2><p>Reduzir as emissões de carbono é a única solução de longo prazo para proteger o ciclo hidrológico global.</p>'
                ]
            ],
            [
                'title' => 'Introdução à Pegada Hídrica',
                'description' => 'Calcule o volume total de água necessário para produzir os bens e serviços que você consome diariamente.',
                'cover_color' => 'dc3545', // Vermelho/Laranja
                'pages' => [
                    '<h2>Página 1: O Que é Pegada Hídrica?</h2><p>É o volume total de água doce usada para produzir bens e serviços consumidos por um indivíduo, comunidade ou empresa.</p>',
                    '<h2>Página 2: Água Virtual</h2><p>A maior parte da sua pegada hídrica está na "água virtual" (aquela usada na produção de alimentos, roupas e eletrônicos).</p>',
                    '<h2>Página 3: Exemplos Chocantes</h2><p>Produzir um quilo de carne bovina pode consumir cerca de 15.000 litros de água. Escolhas alimentares importam.</p>',
                    '<h2>Página 4: Pegada Hídrica Azul, Verde e Cinza</h2><p>Azul (superficial/subterrânea), Verde (chuva) e Cinza (para diluir poluentes). Entenda a diferença.</p>',
                    '<h2>Página 5: Como Reduzir sua Pegada</h2><p>Consumir menos, comer mais vegetais, e comprar produtos de empresas com gestão hídrica transparente.</p>',
                    '<h2>Página 6: Ferramentas de Cálculo</h2><p>Existem calculadoras online para dar uma estimativa do seu impacto e sugerir mudanças.</p>'
                ]
            ]
        ];


        // 2. Apaga todos os ebooks e páginas existentes (para evitar duplicação em execuções repetidas)
        Ebook::query()->delete();

        // 3. Loop para criar todos os E-books e suas 6 páginas
        foreach ($allEbooksData as $data) {
            
            // Cria o Ebook Principal
            $ebook = Ebook::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'cover_path' => 'https://placehold.co/300x400/' . $data['cover_color'] . '/ffffff?text=' . urlencode($data['title']),
                'short_description' => $data['description'],
            ]);

            // Cria as 6 Páginas do Ebook
            for ($i = 0; $i < 6; $i++) {
                 // Acessa o conteúdo da página, garantindo que o índice exista (0 a 5)
                $content = $data['pages'][$i] ?? "<h2>Página " . ($i + 1) . " (Conteúdo Padrão)</h2><p>Ainda não foi definido o conteúdo para esta seção.</p>";

                $ebook->pages()->create([
                    'page_number' => $i + 1, // Números de página de 1 a 6
                    'content' => $content,
                ]);
            }
        }
    }
}