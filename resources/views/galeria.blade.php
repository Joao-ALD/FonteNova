{{--
  View: Galeria Interativa
  - Exibe cards interativos com dicas práticas. Os textos descritivos podem
  - ser expandidos por contributors; a interação é controlada por JS inline.
  - Evitar modificar o comportamento de aria-hidden e estrutura de botões sem
  - verificar acessibilidade / leitores de tela.
--}}
@extends('layouts.main')

@section('content')
<main class="page mb-5 p" >
  <h1>Galeria Interativa</h1>

  <div class="gallery" role="list">

    <button class="card blueish" type="button" data-desc="Instalações simples como calhas e caixas de armazenamento permitem aproveitar a água da chuva para jardinagem e limpeza. Economiza até 30% do consumo doméstico se usado em irrigação e descargas.">
      
      <div class="icon-wrap" aria-hidden="true">
        <img class="img-fluid w-75" src="{{ asset('assets/img/icon_balde.svg') }}" alt="">
      </div>
      
      <div class="caption">Coleta de chuva</div>
      <div class="card-text" style="display:none; margin-top:10px; font-size:13px; color:#053659;"></div>
    </button>

    <button class="card dark" type="button" data-desc="Filtre e reutilize águas de pias e chuveiros (graywater) em sistemas de descarga ou para irrigação. Exige cuidados de tratamento simples — reduz sensivelmente o consumo de água potável.">
     
      <div class="icon-wrap" aria-hidden="true">
        <img class="img-fluid w-75" src="{{ asset('assets/img/icon_water.svg') }}" alt="">
      </div>
    
      <div class="caption">Reuso de água</div>
      <div class="card-text" style="display:none; margin-top:10px; font-size:13px; color:#fff;"></div>
    </button>

    <button class="card" type="button" data-desc="Ações simples: consertar vazamentos, usar descargas econômicas e torneiras com arejador. Pequenas mudanças na rotina podem reduzir o consumo diário por pessoa em até 40 litros.">
     
      <div class="icon-wrap" aria-hidden="true">
        <img class="img-fluid w-75" src="{{ asset('assets/img/icon_hands.svg') }}" alt="">
      </div>
     
      <div class="caption">Cuidados à água</div>
      <div class="card-text" style="display:none; margin-top:10px; font-size:13px; color:#053659;"></div>
    </button>

    <button class="card dark" type="button" data-desc="Filtros com camadas de areia, carvão e cascalho são ótimos para purificar água de reúso ou de chuva. São econômicos e fáceis de montar para uso não potável ou como pré-filtro.">

      <div class="icon-wrap" aria-hidden="true">
        <img class="img-fluid w-50" src="{{ asset('assets/img/icon_filter.svg') }}" alt="">
      </div>

      <div class="caption">Filtros naturais</div>
      <div class="card-text" style="display:none; margin-top:10px; font-size:13px; color:#fff;"></div>
    </button>

 <!-- NOVOS CARDS -->

    <button class="card blueish" type="button" data-desc="O uso de sistemas de irrigação por gotejamento garante que apenas a quantidade necessária de água chegue às plantas, reduzindo desperdício e mantendo o solo sempre úmido.">
      <div class="icon-wrap" aria-hidden="true">
        <img class="img-fluid w-75" src="{{ asset('assets/img/icon_irrigation.svg') }}" alt="">
      </div>
      <div class="caption">Irrigação eficiente</div>
      <div class="card-text" style="display:none; margin-top:10px; font-size:13px; color:#053659;"></div>
    </button>

    <button class="card dark" type="button" data-desc="Compostar restos de alimentos e folhas reduz o lixo doméstico e produz adubo natural. Diminui o uso de fertilizantes químicos e melhora a absorção de água no solo.">
      <div class="icon-wrap" aria-hidden="true">
        <img class="img-fluid w-50" src="{{ asset('assets/img/icon_compost.svg') }}" alt="">
      </div>
      <div class="caption">Compostagem</div>
      <div class="card-text" style="display:none; margin-top:10px; font-size:13px; color:#fff;"></div>
    </button>

    <button class="card" type="button" data-desc="O uso de energia solar para bombear ou aquecer água reduz custos de energia elétrica e torna o sistema mais sustentável a longo prazo.">
      <div class="icon-wrap" aria-hidden="true">
        <img class="img-fluid w-75" src="{{ asset('assets/img/icon_solar.svg') }}" alt="">
      </div>
      <div class="caption">Energia solar</div>
      <div class="card-text" style="display:none; margin-top:10px; font-size:13px; color:#053659;"></div>
    </button>

    <button class="card dark" type="button" data-desc="O reaproveitamento de materiais, como baldes e garrafões, pode gerar soluções criativas para armazenamento e transporte de água. Sustentabilidade começa com a reutilização.">
      <div class="icon-wrap" aria-hidden="true">
        <img class="img-fluid w-75" src="{{ asset('assets/img/icon_reuse.svg') }}" alt="">
      </div>
      <div class="caption">Reaproveitamento</div>
      <div class="card-text" style="display:none; margin-top:10px; font-size:13px; color:#fff;"></div>
    </button>

  </div>

  <div class="legend">Clique em qualquer opção para ver instruções e dicas práticas.</div>
</main>

<style>
  :root{
    --dark-blue:#003f8a;
    --medium-blue:#0b60c7;
    --light-blue:#4da0ff;
    --card-bg:#1a75d8;
    --white:#ffffff;
    --radius:12px;
  }
  *{box-sizing:border-box;}
  body{
    font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
    margin:0; background: #fff; color:#053659;
  }
  .page{
    max-width:1200px; margin:36px auto; padding:0 24px; text-align:center;
  }
  h1{
    color:var(--dark-blue); margin-bottom:30px; font-size:34px; font-weight:800; letter-spacing:0.5px;
  }
  .gallery{
    display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:28px; align-items:start;
  }
  .card{
    background:var(--light-blue); border-radius:var(--radius); padding:34px 18px 22px;
    cursor:pointer; box-shadow:0 6px 14px rgba(0,0,0,0.08);
    display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:260px;
    transition:transform .22s ease, box-shadow .22s ease;
    outline:none; border:none;
  }
  .card:active{transform:scale(.99);}
  .card:focus{box-shadow:0 8px 22px rgba(0,0,0,.15);}
  .card.dark{ background:var(--dark-blue); color:var(--white); }
  .card.blueish{ background: var(--card-bg); }
  .icon-wrap{ width:120px; height:120px; display:flex; align-items:center; justify-content:center; border-radius:14px; margin-bottom:18px; }
  .caption{ font-size:13px; font-weight:500; color:inherit; }
  @media (max-width:560px){
    h1{ font-size:22px }
    .card{ padding:22px 12px; min-height:220px }
    .icon-wrap{ width:96px; height:96px }
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function(){
  const cards = document.querySelectorAll('.card');
  cards.forEach(card => {
    const textEl = card.querySelector('.card-text');
    card.addEventListener('click', () => {
      if(textEl.style.display === 'none'){
        textEl.textContent = card.dataset.desc;
        textEl.style.display = 'block';
      } else {
        textEl.style.display = 'none';
      }
    });
  });
});
</script>
@endsection