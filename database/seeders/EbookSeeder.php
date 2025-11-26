<?php

namespace Database\Seeders; // <-- CORRIGIDO: Agora está no plural

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
                        <p>Ao final deste material, você terá práticas simples para aplicar em casa e na comunidade — pequenas ações que geram grande impacto.</p>
                        <p class="text-center mt-4"><i class="fas fa-tint fa-3x text-info"></i></p>
                    ',
                    // Página 2
                    '
                        <h2>O Ciclo Urbano da Água</h2>
                            <p>Entenda o caminho que a água faz: captação, tratamento, distribuição, uso e retorno ao ambiente. Cada etapa pode ser otimizada para reduzir perdas.</p>
                            <ul>
                                <li>Captação: proteção das nascentes e reservatórios;</li>
                                <li>Tratamento: processos que removem impurezas e tornam a água potável;</li>
                                <li>Distribuição: cuidados com vazamentos e manutenção da rede;</li>
                                <li>Uso e descarte: conscientização sobre consumo e correta destinação de efluentes.</li>
                            </ul>
                                <p>Conhecer o ciclo ajuda a identificar pontos de desperdício e contaminação, permitindo ações direcionadas tanto para cidadãos quanto para gestores públicos.</p>',
                    // Página 3
                    '
                        <h2>Redução do Desperdício em Casa</h2>
                            <p>Uma torneira pingando pode desperdiçar litros por dia; uma descarga com defeito pode desperdiçar centenas. Identificar pequenos vazamentos reduz o consumo imediato.</p>
                            <ul>
                                <li>Substitua torneiras antigas por modelos economizadores;</li>
                                <li>Conserte vazamentos assim que forem detectados;</li>
                                <li>Adote hábitos simples: fechar a torneira ao escovar os dentes e reduzir tempo do banho.</li>
                            </ul>
                                <p>Estas mudanças simples geram economia de água e dinheiro no longo prazo.</p>',
                    // Página 4
                    '
                        <h2>Ações Coletivas</h2>
                            <p>Participar de mutirões de limpeza de rios ou projetos de reflorestamento são formas diretas de contribuir para a saúde hídrica local.</p>
                            <p>Outras ações: cobrar políticas públicas de saneamento, proteger nascentes e apoiar iniciativas de educação ambiental.</p>
                                <p>Engaje escolas, associações e vizinhança — o impacto cresce quando a ação é coletiva.</p>',
                    // Página 5
                    '
                        <h2>Reuso Simples</h2>
                            <p>Coletar água da chuva, separar a água de enxágue de vegetais e direcioná-la para vasos e jardins é uma prática simples e eficaz.</p>
                            <ul>
                                <li>Instale cisternas e torneiras de reúso;</li>
                                <li>Use baldes ao lavar o carro e reutilize a água quando possível;</li>
                                <li>Evite despejar produtos químicos na água reutilizada.</li>
                            </ul>
                                <p>O reuso diminui a dependência de água potável para serviços que não precisam dela.</p>',
                    // Página 6
                    '
                        <h2>Seu Compromisso</h2>
                            <p>A crise hídrica é real, mas pode ser mitigada com ações responsáveis. Crie um plano de 3 passos: identificar desperdícios, agir em casa e compartilhar conhecimento na comunidade.</p>
                            <p class="text-success mt-4 fw-bold">Checklist rápido:</p>
                            <ul>
                                <li>Revise suas torneiras e descargas;</li>
                                <li>Implemente coleta de chuva se possível;</li>
                                <li>Desenvolva campanhas educativas locais.</li>
                            </ul>
                                <p class="text-success mt-4 fw-bold">Fim do Guia — Obrigado por fazer parte da mudança.</p>',
                ]
            ],
            [
                'title' => 'Os 6 R\'s da Sustentabilidade',
                'description' => 'Repense, Recuse, Reduza, Reutilize, Recicle e Repare. O guia completo para um consumo consciente.',
                'cover_color' => '1a3b6e', // Azul Escuro
                'pages' => [
                    '<h2>Página 1: Repense e Recuse</h2><p>Repensar é a etapa de avaliar a real necessidade de consumo. Antes de comprar, pergunte-se: "Eu realmente preciso disso?".</p><p>Recusar embalagens desnecessárias reduz significativamente o volume de resíduos.</p>',
                    '<h2>Página 2: Reduza</h2><p>Reduzir é sobre diminuir a quantidade de produtos e embalagens que compramos.</p><ul><li>Opte por produtos sem embalagens ou com menos plástico;</li><li>Escolha itens em embalagens recicláveis e de várias unidades;</li><li>Prefira produtos duráveis a descartáveis.</li></ul>',
                    '<h2>Página 3: Reutilize</h2><p>Reutilizar é prolongar o tempo de vida dos objetos: transforme potes, frascos e roupas em itens úteis novamente.</p><p>Boas práticas: consertar, adaptar e reaproveitar embalagens para armazenamento.</p>',
                    '<h2>Página 4: Recicle</h2><p>Separar corretamente os resíduos facilita a reciclagem e reduz a quantidade de lixo enviada para aterros.</p><p>Verifique os programas locais de coleta seletiva e participe ativamente.</p>',
                    '<h2>Página 5: Repare</h2><p>Consertar produtos antes de descartá-los prolonga seu uso e economiza materiais e energia.</p><p>Procure serviços de conserto locais e aprenda pequenas manutenções em casa para reduzir descarte precoce.</p>',
                    '<h2>Página 6: Metas Pessoais</h2><p>Defina metas práticas: reduzir consumo de água e energia, recusar sacolas plásticas e comprar produtos locais.</p><p>Documente seus progressos e compartilhe com amigos e familiares para multiplicar o impacto.</p>'
                ]
            ],
            [
                'title' => 'Biodiversidade e Água Doce',
                'description' => 'A relação essencial entre ecossistemas saudáveis e a disponibilidade de água para o consumo humano.',
                'cover_color' => '6c757d', // Cinza
                'pages' => [
                    '<h2>Página 1: Ecossistemas Hídricos</h2><p>Rios, lagos e pântanos abrigam diversidade e funcionam como filtros naturais que retêm sedimentos e purificam a água.</p><p>Preservar esses ecossistemas é garantir fornecimento de água e serviços ambientais.</p>',
                    '<h2>Página 2: A Importância das Matas Ciliares</h2><p>As matas ciliares reduzem erosão, filtram poluentes e oferecem habitat a espécies importantes.</p><p>Manter faixas de vegetação ao redor de corpos d\'água é essencial.</p>',
                    '<h2>Página 3: Serviços Ecossistêmicos</h2><p>Os serviços ambientais fornecem água limpa, regulação das cheias e suporte à biodiversidade.</p><p>Valorizá-los significa apoiar práticas agrícolas e urbanas sustentáveis.</p>',
                    '<h2>Página 4: Fauna Aquática</h2><p>Peixes, anfíbios e macroinvertebrados são indicadores do estado de saúde do ecossistema.</p><p>Monitorar espécies ajuda a identificar impactos e a direcionar ações de recuperação.</p>',
                    '<h2>Página 5: Ameaças</h2><p>Descargas industriais, uso de agrotóxicos e obras sem planejamento comprometem a qualidade da água.</p><p>Reduzir poluentes e fiscalizar empreendimentos é prioridade para conservar a vida aquática.</p>',
                    '<h2>Página 6: O Caminho da Proteção</h2><p>Educação ambiental, reflorestamento e políticas públicas efetivas são essenciais para a proteção de corpos hídricos.</p><p>Participe de iniciativas locais e promova práticas de baixo impacto em sua comunidade.</p>'
                ]
            ],
            [
                'title' => 'Monitoramento da Qualidade da Água',
                'description' => 'Métodos simples e avançados para avaliar se a água é segura para o consumo e para a vida aquática.',
                'cover_color' => '28a745', // Verde
                'pages' => [
                    '<h2>Página 1: Parâmetros Essenciais</h2><p>pH, oxigênio dissolvido, condutividade, turbidez e coliformes são parâmetros chaves para avaliar a água.</p><p>Conheça os intervalos típicos e o que cada parâmetro significa para a vida aquática e saúde humana.</p>',
                    '<h2>Página 2: Testes de Campo</h2><p>Testes de campo rápidos podem indicar problemas: kits de pH, medidores de oxigênio dissolvido e turbidímetros portáteis são úteis.</p><p>Combine observações visuais com testes para resultados mais confiáveis.</p>',
                    '<h2>Página 3: Análise Laboratorial</h2><p>Para detectar metais e pesticidas, amostras devem ser analisadas em laboratórios certificados.</p><p>Planeje a coleta corretamente para evitar contaminação e obtenção de resultados indevidos.</p>',
                    '<h2>Página 4: Bioindicadores</h2><p>Macroinvertebrados e peixes possuem níveis de tolerância à poluição: algumas espécies são sensíveis e sinalizam ambientes saudáveis.</p><p>Use guias locais para identificar espécies e interpretar sinais.</p>',
                    '<h2>Página 5: O Padrão de Potabilidade</h2><p>Entenda os limites de potabilidade para parâmetros como coliformes e metais pesados. Eles garantem a segurança da água de consumo.</p><p>Quando os limites são excedidos, ações rápidas de mitigação são necessárias.</p>',
                    '<h2>Página 6: Relatório Cidadão</h2><p>Como cidadãos, podemos solicitar relatórios de qualidade da água e promover fiscalizações. Informe-se sobre os órgãos responsáveis em sua região.</p><p>Divulgar resultados e participar de audiências públicas ajuda na tomada de decisões mais transparentes.</p>'
                ]
            ],
            [
                'title' => 'Água e Clima: A Conexão Vital',
                'description' => 'Como as mudanças climáticas afetam o ciclo hidrológico e o que isso significa para o abastecimento.',
                'cover_color' => 'ffc107', // Amarelo
                'pages' => [
                    '<h2>Página 1: Aquecimento Global e Chuvas</h2><p>O aumento da temperatura intensifica a evaporação e altera os padrões de chuvas, com eventos extremos mais frequentes.</p><p>O planejamento urbano e agrícola precisa considerar este novo regime de precipitação.</p>',
                    '<h2>Página 2: Degelo</h2><p>O degelo de geleiras compromete fontes de água doce para milhões de pessoas. Regiões dependentes dessas reservas devem buscar adaptação e novas fontes.</p>',
                    '<h2>Página 3: Impacto na Agricultura</h2><p>Safras sensíveis às chuvas serão afetadas; técnicas como manejo de solo e irrigação eficiente ajudam a reduzir vulnerabilidade.</p>',
                    '<h2>Página 4: Desertificação</h2><p>O uso inadequado do solo e a perda de cobertura vegetal aceleram a desertificação, reduzindo a capacidade de recarga de aquíferos e a retenção de água.</p>',
                    '<h2>Página 5: Adaptação</h2><p>Adaptação inclui infraestrutura resiliente, conservação de solos, sistemas de reuso, e políticas que priorizem segurança hídrica.</p><ul><li>Reservatórios e cisternas;</li><li>Sistemas de irrigação eficientes;</li><li>Reflorestamento de bacias estratégicas.</li></ul>',
                    '<h2>Página 6: Mitigação</h2><p>Mitigação passa por reduzir emissões de gases de efeito estufa, promover energias renováveis e políticas sustentáveis que preservem ciclos naturais.</p>'
                ]
            ],
            [
                'title' => 'Introdução à Pegada Hídrica',
                'description' => 'Calcule o volume total de água necessário para produzir os bens e serviços que você consome diariamente.',
                'cover_color' => 'dc3545', // Vermelho/Laranja
                'pages' => [
                    '<h2>Página 1: O Que é Pegada Hídrica?</h2><p>É o volume total de água doce usada para produzir bens e serviços consumidos por um indivíduo, comunidade ou empresa. Inclui água direta e indireta usada em cadeias produtivas.</p>',
                    '<h2>Página 2: Água Virtual</h2><p>Água virtual refere-se à água incorporada em alimentos e produtos. Exemplo: fabricar um quilo de arroz usa água na irrigação e processamento.</p>',
                    '<h2>Página 3: Exemplos Práticos</h2><p>Alguns valores médios (variam por região): 1 kg de carne bovina ~15.000 L; 1 xícara de café ~140 L (considerando produção). Escolhas alimentares influenciam a pegada.</p>',
                    '<h2>Página 4: Tipos de Pegada Hídrica</h2><p>Azul, Verde e Cinza representam fontes e impactos da água. Compreender essas categorias ajuda a reduzir seu impacto.</p>',
                    '<h2>Página 5: Como Reduzir sua Pegada</h2><p>Mudar hábitos alimentares, evitar desperdício e preferir produtos locais e sazonais são formas eficazes de reduzir a pegada.</p><ul><li>Prefira alimentos com menor demanda hídrica;</li><li>Reduza desperdício de alimentos;</li><li>Procure produtos e marcas com transparência hídrica.</li></ul>',
                    '<h2>Página 6: Ferramentas de Cálculo</h2><p>Calculadoras de pegada hídrica ajudam a estimar seu impacto e sugerir ações. Registre seus alimentos e hábitos para entender seu perfil hídrico.</p>'
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