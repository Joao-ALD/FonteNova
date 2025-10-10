{{--
  View: Galeria Interativa
  - Exibe cards interativos com dicas práticas. Os textos descritivos podem
  - ser expandidos por contributors; a interação é controlada por JS inline.
  - Evitar modificar o comportamento de aria-hidden e estrutura de botões sem
  - verificar acessibilidade / leitores de tela.
--}}
@extends('layouts.main')

@section('content')
<main class="page">
  <h1>Galeria Interativa</h1>

  <div class="gallery" role="list">

    <button class="card blueish" type="button" data-desc="Instalações simples como calhas e caixas de armazenamento permitem aproveitar a água da chuva para jardinagem e limpeza. Economiza até 30% do consumo doméstico se usado em irrigação e descargas.">
      <div class="icon-wrap" aria-hidden="true">
        <svg width="110" height="110" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M32 4c0 0-12 12-12 20 0 8 5 12 12 12s12-4 12-12C44 16 32 4 32 4z" fill="#fff"/>
          <rect x="14" y="40" width="36" height="12" rx="2" fill="#083e6b"/>
        </svg>
      </div>
      <div class="caption">Coleta de chuva</div>
      <div class="card-text" style="display:none; margin-top:10px; font-size:13px; color:#053659;"></div>
    </button>

    <button class="card dark" type="button" data-desc="Filtre e reutilize águas de pias e chuveiros (graywater) em sistemas de descarga ou para irrigação. Exige cuidados de tratamento simples — reduz sensivelmente o consumo de água potável.">
      <div class="icon-wrap" aria-hidden="true">
        <svg width="110" height="110" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M32 6c-4 5-8 8-8 14 0 9 7 16 8 16s8-7 8-16c0-6-4-9-8-14z" fill="#fff" stroke="#07284a" stroke-width="2"/>
          <path d="M28 36c3 3 7 3 10 0" stroke="#07284a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="caption">Reuso de água</div>
      <div class="card-text" style="display:none; margin-top:10px; font-size:13px; color:#fff;"></div>
    </button>

    <button class="card" type="button" data-desc="Ações simples: consertar vazamentos, usar descargas econômicas e torneiras com arejador. Pequenas mudanças na rotina podem reduzir o consumo diário por pessoa em até 40 litros.">
      <div class="icon-wrap" aria-hidden="true">
        <svg width="110" height="110" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="32" cy="22" r="8" fill="#083e6b"/>
          <path d="M16 44s6-6 16-6 16 6 16 6" stroke="#07284a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="caption">Cuidados à água</div>
      <div class="card-text" style="display:none; margin-top:10px; font-size:13px; color:#053659;"></div>
    </button>

    <button class="card dark" type="button" data-desc="Filtros com camadas de areia, carvão e cascalho são ótimos para purificar água de reúso ou de chuva. São econômicos e fáceis de montar para uso não potável ou como pré-filtro.">
      <div class="icon-wrap" aria-hidden="true">
        <svg width="110" height="110" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
          <rect x="18" y="12" width="28" height="40" rx="4" fill="#fff" stroke="#07284a" stroke-width="2"/>
          <circle cx="32" cy="26" r="2" fill="#07284a"/>
          <circle cx="32" cy="34" r="2" fill="#07284a"/>
          <circle cx="32" cy="42" r="2" fill="#07284a"/>
        </svg>
      </div>
      <div class="caption">Filtros naturais</div>
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