@extends('layouts.main')

@section('content')

  <section class="container d-flex flex-column justify-content-center align-items-center text-center min-vh-100">
    <!-- Título -->
    <h1 class="display-1 fw-bold p">Tudo sobre a Água</h1>

    <!-- Subtítulo -->
    <p class="lead mt-3">
      Explore o mundo água: do clima à preservação, entenda como cada ação impacta o nosso recurso mais precioso.
    </p>

    <!-- Botões do topicos Clima,Coleta,Consumo,Preservacao -->
    <div class="mt-4 d-flex flex-wrap justify-content-center gap-3">
      <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapseClima" aria-expanded="false" aria-controls="collapseClima">
        Clima
      </button>

      <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapseColeta" aria-expanded="false" aria-controls="collapseColeta">
        Coleta
      </button>

      <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapseConsumo" aria-expanded="false" aria-controls="collapseConsumo">
        Consumo
      </button>

      <button class="btn btn-outline-primary btn-lg px-4" type="button" data-bs-toggle="collapse"
        data-bs-target="#collapsePreservacao" aria-expanded="false" aria-controls="collapsePreservacao">
        Preservação
      </button>
    </div>



    <div class="container mt-5" id="infoPanels">

      <!-- Card Clima -->
      <div class="collapse" id="collapseClima" data-bs-parent="#infoPanels">
        <div class="row g-4">
          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Clima</h5>
                <p class="card-text text-white text-center" style="margin-top: 20px;">
                  O clima desempenha um papel fundamental na disponibilidade de água no planeta. Mudanças climáticas
                  intensificam eventos extremos como secas prolongadas e enchentes, afetando diretamente rios, lagos e
                  aquíferos subterrâneos. Regiões com chuvas irregulares enfrentam escassez, enquanto áreas com excesso de
                  precipitação correm risco de inundações. Assim, o clima é o primeiro fator que determina a quantidade e
                  a qualidade da água disponível. </p>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Coleta de Água da chuva</h5>
                <p class="card-text text-white text-center" style="margin-top: 20px;">
                  A coleta de água da chuva é uma forma sustentável de captar e armazenar água para uso doméstico,
                  agrícola ou industrial. Técnicas como telhados coletores, cisternas e sistemas de filtragem permitem
                  aproveitar a água pluvial, reduzindo a dependência de fontes convencionais. Essa prática é essencial em
                  regiões com baixa disponibilidade hídrica e contribui para a autonomia hídrica das comunidades.
                </p>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Comsumo</h5>
                <p class="card-text text-white text-center" style="margin-top: 20px;">
                  O consumo consciente de água é crucial para garantir sua disponibilidade futura. Desde o uso doméstico
                  até a agricultura e a indústria, cada setor precisa otimizar seu uso. Reduzir desperdícios, manter
                  instalações hidráulicas em bom estado e adotar tecnologias eficientes são medidas simples, mas
                  poderosas, para preservar esse recurso vital.
                </p>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Preservação</h5>
                <p class="card-text text-white text-center" style="margin-top: 20px;">
                  Preservar a água envolve proteger fontes naturais, como rios, nascentes e mananciais, além de promover
                  práticas ambientais sustentáveis. Isso inclui a recuperação de áreas degradadas, controle da poluição e
                  educação ambiental. A preservação garante que a água permaneça limpa, disponível e acessível para as
                  gerações futuras.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Coleta (4 cards) -->
      <div class="collapse" id="collapseColeta" data-bs-parent="#infoPanels">
        <div class="row g-4">
          <!-- Coleta -->
          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Coleta</h5>
                <p class="card-text text-white text-center">
                  A coleta de água é o primeiro passo para garantir o acesso a esse recurso essencial. Ela representa o
                  conjunto de práticas que permitem reunir a água disponível no ambiente para posterior uso. A coleta pode
                  ser feita de forma simples, como em casas que aproveitam a chuva, ou em larga escala, por meio de
                  estruturas construídas para abastecer comunidades inteiras. Esse processo é indispensável para dar
                  início às etapas de captação, armazenamento e filtragem.  📌 Exemplo: Uma comunidade pode organizar um
                  sistema de coleta coletiva da água da chuva para reduzir a dependência de caminhões-pipa.
                </p>
              </div>
            </div>
          </div>

          <!-- Captação -->
          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Captação</h5>
                <p class="card-text text-white text-center">
                  A captação é o processo de recolher a água da chuva ou de outras fontes naturais e artificiais. Essa
                  etapa é fundamental para iniciar o ciclo de abastecimento. Pode ser feita por meio de telhados, calhas e
                  canaletas que direcionam a água da chuva para reservatórios, além da coleta em rios, lagos e poços
                  artesianos. Em contextos maiores, indústrias utilizam sistemas próprios de coleta, enquanto barragens e
                  represas armazenam grandes volumes para abastecer cidades inteiras.  📌 Exemplo: Em casas rurais, o
                  telhado funciona como coletor natural da água da chuva, conduzindo-a para cisternas.
                </p>
              </div>
            </div>
          </div>

          <!-- Armazenamento -->
          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Armazenamento</h5>
                <p class="card-text text-white text-center">
                  Após a coleta, a água precisa ser armazenada em locais adequados para garantir disponibilidade futura.
                  Esse armazenamento pode acontecer em cisternas domésticas, reservatórios públicos urbanos, tanques
                  plásticos ou de concreto, e até em sistemas subterrâneos, como os aquíferos naturais. Essa etapa é
                  essencial para enfrentar períodos de estiagem e evitar a falta de água, tanto em áreas rurais quanto em
                  grandes cidades.  📌 Dica: Manter a água armazenada corretamente ajuda a prevenir desperdícios e
                  assegura o uso contínuo em situações de seca.
                </p>
              </div>
            </div>
          </div>

          <!-- Filtragem -->
          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Filtragem</h5>
                <p class="card-text text-white text-center">
                  A filtragem é o passo que torna a água mais limpa e segura para uso humano e agrícola. Existem diversos
                  métodos de purificação, desde os simples até os mais avançados. Filtros de cerâmica ou carvão ativado
                  são comuns em residências, enquanto sistemas de areia e cascalho podem ser usados em comunidades rurais.
                  Além disso, a desinfecção com cloro ou luz ultravioleta garante a eliminação de microrganismos nocivos. 
                  📌 Exemplo: Uma família pode utilizar um filtro de carvão ativado para transformar a água armazenada na
                  cisterna em água potável.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Consumo -->
      <div class="collapse" id="collapseConsumo" data-bs-parent="#infoPanels">
        <div class="row g-4">

          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Consumo Consciente</h5>
                <p class="card-text text-white text-center" style="margin-top: 20px;">
                  Adotar o consumo consciente da água significa refletir sobre como utilizamos esse recurso em todas as
                  atividades do dia a dia. Pequenos hábitos, muitas vezes automáticos, podem estar gerando desperdícios
                  que passam despercebidos. Ao repensar atitudes simples, como evitar banhos prolongados, reutilizar a
                  água da máquina de lavar para limpeza ou dar preferência a torneiras com fechamento automático,
                  garantimos não apenas economia na conta de água, mas também contribuímos para a preservação ambiental.
                  Cada litro economizado faz diferença para o planeta e para as futuras gerações.
                </p>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Monitoramento</h5>
                <p class="card-text text-white text-center" style="margin-top: 20px;">
                  O monitoramento constante do consumo de água é uma das formas mais eficazes de identificar desperdícios
                  e propor melhorias. Manter o hábito de verificar hidrômetros, analisar contas mensais e até utilizar
                  aplicativos de gestão hídrica ajuda a perceber padrões de gasto que poderiam ser ajustados. Muitas
                  vezes, um aumento repentino no consumo pode indicar vazamentos escondidos, que passam despercebidos no
                  dia a dia. Ter esse controle é essencial para agir de forma preventiva e transformar a forma como
                  utilizamos a água em casa, no trabalho e em comunidades.
                </p>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Pequenas Mudanças</h5>
                <p class="card-text text-white text-center" style="margin-top: 20px;">
                  As grandes transformações começam com pequenas atitudes. Fechar a torneira enquanto escova os dentes,
                  juntar roupas para lavar de uma só vez, optar por regadores em vez de mangueiras ou coletar água da
                  chuva para regar plantas são exemplos de práticas simples que reduzem significativamente o consumo. Cada
                  mudança individual, quando multiplicada por milhões de pessoas, gera um impacto coletivo gigantesco na
                  preservação da água. Essas ações não exigem grandes investimentos, apenas consciência e comprometimento
                  com o futuro.
                </p>
              </div>
            </div>
          </div>

          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Tecnologia</h5>
                <p class="card-text text-white text-center" style="margin-top: 20px;">
                  A tecnologia é uma grande aliada na economia e no uso inteligente da água. Hoje já existem sensores e
                  hidrômetros digitais que monitoram em tempo real o gasto doméstico, aplicativos que alertam sobre
                  consumos fora do padrão e sistemas inteligentes que otimizam o uso em empresas, indústrias e até nas
                  cidades. Além disso, equipamentos como descargas de baixo consumo, torneiras automáticas e máquinas de
                  lavar mais econômicas contribuem para um uso mais eficiente. Com essas ferramentas, é possível unir
                  inovação e sustentabilidade para transformar nossa relação com esse recurso tão valioso.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Card Preservação -->
      <div class="collapse" id="collapsePreservacao" data-bs-parent="#infoPanels">
        <div class="row g-4">
          <div class="col-12">
            <div class="card text-start bg-card mb-3 mx-auto" style="width: 90%; height: 18rem;">
              <div class="card-body">
                <h5 class="card-title text-white text-end">Preservação</h5>
                <p class="card-text text-white text-center" style="margin-top: 20px;">
                  Preservar a água envolve proteger fontes naturais, como rios, nascentes e mananciais...
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <script>
    const buttons = document.querySelectorAll('.btn[data-bs-toggle="collapse"]');

    buttons.forEach(btn => {
      btn.addEventListener('click', function () {
        // Se o botão já estiver ativo
        if (this.classList.contains('active')) {
          this.classList.remove('active'); // desativa
        } else {
          // Remove active de todos os outros
          buttons.forEach(b => b.classList.remove('active'));
          // Ativa o clicado
          this.classList.add('active');
        }
      });
    });
  </script>
@endsection