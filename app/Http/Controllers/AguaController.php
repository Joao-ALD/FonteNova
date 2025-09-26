<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AguaController extends Controller
{
    public function index()
    {
        $topics = [

            // 🌍 CLIMA
            "Clima" => [
                [
                    "title" => "Chuvas",
                    "text" => "As chuvas são fundamentais para manter o ciclo da água e a fertilidade do solo. Elas ajudam a recarregar aquíferos subterrâneos e rios que abastecem cidades. No entanto, quando caem de forma intensa em pouco tempo, podem provocar enchentes. A má gestão urbana aumenta os riscos, com ruas asfaltadas e pouca área verde. Em áreas rurais, a chuva garante a produção agrícola. Mas a irregularidade das precipitações gera perdas de colheitas. Com as mudanças climáticas, os padrões de chuva se tornaram imprevisíveis. Isso obriga a sociedade a investir em técnicas de aproveitamento sustentável. A captação de água da chuva em cisternas é uma alternativa prática. Dessa forma, as chuvas podem ser vistas mais como recurso do que como ameaça.",
                    "image" => "chuvas.jpg"
                ],
                [
                    "title" => "Secas",
                    "text" => "As secas são longos períodos sem chuva que afetam o abastecimento de água. Elas prejudicam a agricultura, diminuem safras e aumentam o preço dos alimentos. A pecuária também sofre, já que falta pastagem para os animais. Muitas famílias em áreas rurais migram em busca de melhores condições. O fenômeno é natural, mas tem sido agravado pelas mudanças climáticas. A falta de planejamento hídrico aumenta os impactos sociais e econômicos. Reservatórios secos dificultam a geração de energia elétrica. Em cidades, a seca pode levar ao racionamento de água. Tecnologias de irrigação inteligente ajudam a reduzir perdas. É essencial adotar medidas preventivas para conviver melhor com esse fenômeno.",
                    "image" => "secas.jpg"
                ],
                [
                    "title" => "Temperatura",
                    "text" => "O aumento da temperatura acelera a evaporação da água em lagos e rios. Isso compromete a disponibilidade hídrica em várias regiões. A agricultura precisa usar mais irrigação para manter a produção. Cidades enfrentam ondas de calor que aumentam o consumo doméstico de água. O calor excessivo também agrava problemas de saúde, como desidratação. Espécies aquáticas sofrem com o aquecimento dos rios. A biodiversidade fica ameaçada pela alteração dos habitats naturais. O aumento das temperaturas está diretamente ligado ao efeito estufa. Reduzir emissões de gases poluentes ajuda a equilibrar o clima. Esse desafio exige cooperação global e mudanças de hábitos de consumo.",
                    "image" => "temperatura.jpg"
                ],
                [
                    "title" => "Eventos Extremos",
                    "text" => "Furacões, enchentes e tempestades são exemplos de eventos climáticos extremos. Eles causam prejuízos milionários em poucas horas. Além da destruição de casas, afetam redes de água e esgoto. Comunidades vulneráveis sofrem mais nesses momentos. Muitas vezes, a recuperação leva anos. A infraestrutura urbana precisa ser adaptada para resistir a esses fenômenos. Sistemas de alerta precoce salvam vidas. A preservação de florestas e rios ajuda a reduzir danos. Investimentos em engenharia hidráulica são fundamentais. Esses eventos extremos mostram a urgência de políticas ambientais sérias.",
                    "image" => "eventos.jpg"
                ],
                [
                    "title" => "Mudanças Climáticas",
                    "text" => "As mudanças climáticas já estão afetando o ciclo da água no planeta. Regiões chuvosas podem enfrentar longos períodos de estiagem. Locais secos sofrem com tempestades inesperadas. O derretimento de geleiras aumenta o nível do mar e ameaça áreas costeiras. Rios que dependem do gelo derretido ficam com menos água. Agricultores precisam se adaptar a novos cenários. Muitas espécies de plantas e animais não conseguem sobreviver. O consumo humano também se torna um desafio. Fontes renováveis de energia ajudam a diminuir o problema. Mas a conscientização da população é igualmente necessária.",
                    "image" => "mudancas.jpg"
                ],
                [
                    "title" => "Impactos Regionais",
                    "text" => "Cada região do mundo sente os efeitos climáticos de forma diferente. O Nordeste brasileiro, por exemplo, sofre com secas prolongadas. Já o Sul enfrenta enchentes constantes. Regiões montanhosas perdem suas geleiras rapidamente. O Ártico é um dos locais mais afetados pelo aquecimento global. Áreas costeiras estão em risco de submersão. Essa diversidade de impactos exige políticas específicas. Não existe solução única para todos os lugares. O planejamento deve considerar características locais. Só assim é possível reduzir os danos das mudanças climáticas.",
                    "image" => "regionais.jpg"
                ],
            ],

            // 💧 COLETA
            "Coleta" => [
                [
                    "title" => "Captação de Chuva",
                    "text" => "A coleta de água da chuva é uma prática antiga e sustentável. Cisternas e calhas são formas simples de armazenar esse recurso. Essa água pode ser usada para regar plantas e limpar ambientes. Quando tratada, também serve para consumo humano. Essa prática ajuda a reduzir a dependência de sistemas públicos. É especialmente importante em regiões de seca. O aproveitamento da chuva diminui enchentes urbanas. Além disso, contribui para a economia doméstica. Governos incentivam projetos de captação em comunidades carentes. A valorização dessa prática é um passo importante para a sustentabilidade.",
                    "image" => "chuva.jpg"
                ],
                [
                    "title" => "Águas Subterrâneas",
                    "text" => "Os aquíferos são reservas naturais de água no subsolo. Muitas cidades dependem deles para abastecimento. No entanto, a exploração excessiva pode causar colapso. Poços artesianos são comuns em áreas rurais. A poluição do solo ameaça a qualidade dessas águas. Vazamentos de combustíveis e agrotóxicos contaminam os aquíferos. A recarga natural ocorre com chuvas, mas tem diminuído. O desmatamento prejudica essa reposição. É essencial monitorar o uso dos aquíferos. Assim, garantimos esse recurso para as futuras gerações.",
                    "image" => "subterraneas.jpg"
                ],
                [
                    "title" => "Rios e Nascentes",
                    "text" => "Rios e nascentes são fontes tradicionais de água potável. Eles sustentam ecossistemas inteiros. No entanto, a poluição urbana e industrial ameaça sua qualidade. O desmatamento das margens prejudica a vazão. Muitas comunidades ainda dependem de nascentes locais. Programas de proteção ajudam a manter essas fontes vivas. O reflorestamento é uma medida eficaz. A fiscalização de despejo de resíduos é fundamental. A conscientização popular também faz diferença. Proteger rios e nascentes é proteger a vida.",
                    "image" => "rios.jpg"
                ],
                [
                    "title" => "Desalinização",
                    "text" => "A desalinização transforma água do mar em potável. É uma alternativa para regiões costeiras sem rios ou lagos. Porém, o processo consome muita energia. Países do Oriente Médio utilizam amplamente essa técnica. A tecnologia está avançando para reduzir custos. No Brasil, projetos começam a ser testados no Nordeste. A desalinização pode ser solução futura para a escassez. Mas precisa ser usada com cautela. Impactos ambientais devem ser considerados. É uma ferramenta complementar, não única.",
                    "image" => "desalinizacao.jpg"
                ],
                [
                    "title" => "Reuso de Água",
                    "text" => "O reuso de água trata esgotos para nova utilização. Essa prática reduz o desperdício em indústrias e cidades. A água de reuso serve para irrigação e limpeza urbana. Também ajuda em processos industriais. A tecnologia já é aplicada em diversos países. No Brasil, ainda está em crescimento. O preconceito cultural é uma barreira. Campanhas educativas podem mudar essa visão. Reaproveitar água é essencial em tempos de crise. Essa prática precisa ser cada vez mais comum.",
                    "image" => "reuso.jpg"
                ],
                [
                    "title" => "Tecnologias de Coleta",
                    "text" => "Novas tecnologias melhoram a eficiência da coleta de água. Sensores monitoram a qualidade em tempo real. Sistemas inteligentes ajustam a captação conforme a demanda. Telhados verdes ajudam a armazenar chuva. Barragens modernas reduzem perdas de evaporação. A inovação também reduz custos operacionais. Pesquisadores buscam materiais mais resistentes. O futuro da coleta depende da ciência. Investimentos nesse setor são urgentes. A tecnologia é aliada na preservação da água.",
                    "image" => "tecnologias.jpg"
                ],
            ],

            // 🚰 CONSUMO
            "Consumo" => [
                [
                    "title" => "Doméstico",
                    "text" => "O consumo doméstico representa grande parte da demanda por água nas cidades. Ela é utilizada em atividades básicas como beber, cozinhar, tomar banho e limpar. Muitas vezes, esse uso é feito de forma exagerada, causando desperdício. O simples ato de deixar a torneira aberta pode gastar litros preciosos. Em casas e apartamentos, o uso de descargas e chuveiros é responsável pela maior parte do consumo. O desperdício também ocorre em vazamentos que passam despercebidos. Campanhas educativas têm mostrado alternativas para economizar. Instalar torneiras econômicas e sistemas de reaproveitamento faz diferença. A conscientização dentro das famílias é essencial para reduzir gastos. O consumo doméstico eficiente ajuda a garantir água para todos.",
                    "image" => "domestico.jpg"
                ],
                [
                    "title" => "Agrícola",
                    "text" => "A agricultura é o setor que mais consome água no mundo. A irrigação intensiva garante o cultivo de alimentos, mas gasta enormes quantidades. Em muitas regiões, técnicas ultrapassadas aumentam as perdas. O uso de canais abertos, por exemplo, desperdiça água por evaporação. Novas tecnologias, como a irrigação por gotejamento, reduzem esse problema. Além disso, o plantio de espécies adaptadas ao clima local ajuda a economizar. A gestão da água na agricultura é um desafio global. Sem mudanças, será difícil alimentar toda a população no futuro. Incentivos governamentais podem estimular práticas mais eficientes. O equilíbrio entre produção e preservação é a chave.",
                    "image" => "agricola.jpg"
                ],
                [
                    "title" => "Industrial",
                    "text" => "O setor industrial também é um grande consumidor de água. Ela é usada em processos de resfriamento, limpeza e produção de bens. Indústrias de papel, bebidas e têxteis estão entre as que mais consomem. Muitas vezes, a água retorna poluída aos rios. Essa poluição compromete ecossistemas inteiros. Empresas modernas já investem em tratamento e reuso. Isso reduz custos e melhora a imagem da marca. Tecnologias sustentáveis estão cada vez mais acessíveis. A responsabilidade social empresarial também pressiona por mudanças. Reduzir o consumo industrial é parte essencial da sustentabilidade.",
                    "image" => "industrial.jpg"
                ],
                [
                    "title" => "Energia",
                    "text" => "A produção de energia está diretamente ligada ao uso da água. Usinas hidrelétricas dependem de rios e reservatórios. A seca pode comprometer o fornecimento elétrico de um país. Outras fontes, como as termelétricas, também usam grandes volumes para resfriamento. O avanço das energias renováveis ajuda a reduzir essa dependência. A energia solar e eólica consomem menos água. No entanto, a transição ainda é lenta em muitos países. Investir em alternativas é urgente para evitar crises. A integração entre setor hídrico e elétrico é fundamental. Água e energia caminham lado a lado na sustentabilidade.",
                    "image" => "energia.jpg"
                ],
                [
                    "title" => "Turismo e Lazer",
                    "text" => "O turismo também depende fortemente da água. Piscinas, parques aquáticos e hotéis consomem grandes volumes diariamente. Em regiões litorâneas, a demanda cresce na alta temporada. O turismo rural também depende de rios e cachoeiras limpos. Quando mal administrado, esse consumo causa impactos ambientais. O uso consciente pode transformar o turismo em aliado da preservação. Empreendimentos sustentáveis já adotam sistemas de reuso. Além disso, turistas conscientes ajudam a reduzir o desperdício. A valorização da água como patrimônio natural é essencial. Assim, o turismo pode ser um motor de preservação, e não de destruição.",
                    "image" => "turismo.jpg"
                ],
                [
                    "title" => "Consumo Sustentável",
                    "text" => "O consumo sustentável de água é um desafio coletivo. Ele depende de mudanças de hábito em todos os setores. Significa usar apenas o necessário e evitar desperdícios. Tecnologias modernas ajudam nesse processo, mas a educação é fundamental. Nas cidades, pequenas atitudes fazem diferença. Nas indústrias, a inovação é o caminho. Na agricultura, a eficiência é indispensável. O consumo sustentável também envolve políticas públicas. Incentivos e legislações podem transformar a realidade. Garantir água para o futuro depende de escolhas conscientes no presente.",
                    "image" => "sustentavel.jpg"
                ],
            ],

            // 🌱 PRESERVAÇÃO
            "Preservação" => [
                [
                    "title" => "Educação Ambiental",
                    "text" => "A educação ambiental é uma das ferramentas mais poderosas para preservar a água. Quando as pessoas entendem o valor desse recurso, passam a cuidar melhor dele. Escolas desempenham papel essencial nesse processo. Projetos comunitários também ajudam a espalhar conhecimento. Campanhas públicas estimulam mudanças de comportamento. Crianças educadas hoje se tornam adultos conscientes amanhã. A informação gera responsabilidade. Quanto mais pessoas envolvidas, maior o impacto positivo. A educação cria uma cultura de respeito à natureza. Preservar começa pelo conhecimento.",
                    "image" => "educacao.jpg"
                ],
                [
                    "title" => "Legislação e Políticas",
                    "text" => "As leis ambientais são fundamentais para proteger recursos hídricos. Elas determinam limites de uso e punem poluidores. Políticas públicas de saneamento melhoram a qualidade da água. Incentivos governamentais estimulam o uso racional. No entanto, a fiscalização precisa ser eficiente. Sem aplicação prática, leis se tornam ineficazes. A participação social também fortalece as políticas. Movimentos ambientais pressionam por melhorias. A legislação deve ser constantemente atualizada. Só assim é possível acompanhar os novos desafios.",
                    "image" => "legislacao.jpg"
                ],
                [
                    "title" => "Gestão Integrada",
                    "text" => "A gestão integrada da água considera todos os usos do recurso. Isso inclui agricultura, indústria, energia e consumo doméstico. Quando cada setor age isoladamente, surgem conflitos. A integração garante equilíbrio entre demandas. Conselhos de gestão hídrica já funcionam em alguns países. Eles reúnem governo, empresas e sociedade civil. O diálogo é fundamental para encontrar soluções. A gestão integrada também prevê crises futuras. Com planejamento, é possível reduzir impactos. Esse modelo é essencial para a preservação da água.",
                    "image" => "gestao.jpg"
                ],
                [
                    "title" => "Reflorestamento",
                    "text" => "O reflorestamento ajuda diretamente na preservação da água. Árvores mantêm o solo úmido e reduzem a erosão. Elas também favorecem a infiltração da chuva nos aquíferos. Áreas de nascentes precisam de proteção especial. O desmatamento compromete a qualidade da água nos rios. Plantar árvores é um investimento no futuro. Projetos de reflorestamento têm crescido em várias regiões. Comunidades inteiras já participam dessas iniciativas. Além dos benefícios hídricos, há ganho para a biodiversidade. Reflorestar é restaurar o equilíbrio ambiental.",
                    "image" => "reflorestamento.jpg"
                ],
                [
                    "title" => "Uso Consciente",
                    "text" => "O uso consciente da água deve ser praticado diariamente. Significa pensar antes de gastar. Uma torneira fechada no momento certo evita desperdícios. Banhos rápidos economizam centenas de litros por mês. Empresas também precisam rever processos internos. A agricultura deve buscar eficiência sempre. O consumo consciente envolve responsabilidade coletiva. Cada pessoa tem papel nesse processo. A soma das pequenas atitudes gera grandes resultados. Preservar a água é preservar a vida.",
                    "image" => "uso.jpg"
                ],
                [
                    "title" => "Cooperação Internacional",
                    "text" => "A água não respeita fronteiras. Muitos rios atravessam diferentes países. Isso exige cooperação internacional na gestão. Sem diálogo, conflitos podem surgir. A ONU promove acordos entre nações nesse sentido. Compartilhar tecnologias também é importante. Países com mais recursos podem ajudar os mais vulneráveis. A cooperação cria soluções conjuntas. Crises hídricas são problemas globais. Trabalhar em conjunto fortalece todos os povos. A água deve ser vista como patrimônio comum da humanidade.",
                    "image" => "cooperacao.jpg"
                ],
            ],
        ];


        return view('agua');
    }
}
