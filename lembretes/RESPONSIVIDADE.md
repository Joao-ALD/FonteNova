# 📱 Guia de Responsividade - FonteNova

## 🎯 Correções Implementadas

### 1. **Navbar (Menu de Navegação)**
- ✅ Menu hamburguer funcional em mobile
- ✅ Itens centralizados em telas pequenas
- ✅ Background com transparência no collapse
- ✅ Logo redimensionada automaticamente

### 2. **Footer (Rodapé)**
- ✅ Colunas empilhadas em mobile
- ✅ Conteúdo centralizado em telas pequenas
- ✅ Ícones sociais centralizados
- ✅ Espaçamento adequado entre seções

### 3. **Mapa Interativo**
- ✅ SVG responsivo (escala automaticamente)
- ✅ Card de informações fixo na parte inferior em mobile
- ✅ Altura ajustada para telas pequenas (300px)
- ✅ Scroll interno no card quando necessário

### 4. **Cards e Containers**
- ✅ Padding reduzido em mobile
- ✅ Quebra de texto automática
- ✅ Largura máxima respeitada
- ✅ Overflow controlado

### 5. **Botões**
- ✅ Texto quebra em múltiplas linhas se necessário
- ✅ Tamanho de fonte ajustado em mobile
- ✅ Padding responsivo
- ✅ Largura 100% em telas muito pequenas

### 6. **Formulários**
- ✅ Input groups empilhados em mobile
- ✅ Botões ocupam largura total
- ✅ Espaçamento adequado entre campos
- ✅ Largura 100% garantida

### 7. **Tipografia**
- ✅ Tamanhos de fonte com `clamp()` (escala fluida)
- ✅ H1: 1.75rem - 3rem
- ✅ H2: 1.5rem - 2.5rem
- ✅ H3: 1.25rem - 2rem
- ✅ Parágrafos: 0.875rem - 1rem

### 8. **ChatBot**
- ✅ Campo de entrada 100% da largura
- ✅ Botões de sugestão empilhados em mobile
- ✅ Área de resposta responsiva
- ✅ Fonte reduzida em telas pequenas

### 9. **Quiz**
- ✅ Container com padding ajustado
- ✅ Botões de resposta em coluna
- ✅ Largura 100% para todas as opções
- ✅ Texto alinhado à esquerda

### 10. **Sistema de Cursos**
- ✅ Sidebar sticky em desktop
- ✅ Sidebar normal em mobile (não fica fixa)
- ✅ Vídeos responsivos com aspect ratio 16:9
- ✅ Navegação anterior/próxima adaptada

### 11. **Galeria**
- ✅ Cards com largura máxima
- ✅ Centralizados automaticamente
- ✅ Grid responsivo
- ✅ Imagens escaladas proporcionalmente

### 12. **Hero Section (Home)**
- ✅ Título com tamanho fluido (2rem - 3.5rem)
- ✅ Subtítulo responsivo
- ✅ Ilustração redimensionada em mobile
- ✅ Centralização automática em telas pequenas

## 📐 Breakpoints Utilizados

```css
/* Extra Small (Mobile) */
@media (max-width: 576px) { }

/* Small (Tablets) */
@media (max-width: 768px) { }

/* Medium (Tablets Landscape) */
@media (max-width: 991px) { }

/* Large (Desktop) */
@media (min-width: 992px) { }
```

## 🔧 Técnicas Aplicadas

### 1. **Fluid Typography**
```css
h1 {
    font-size: clamp(1.75rem, 5vw, 3rem);
}
```
- Tamanho mínimo: 1.75rem
- Tamanho ideal: 5% da largura da viewport
- Tamanho máximo: 3rem

### 2. **Responsive Images**
```css
img {
    max-width: 100%;
    height: auto;
}
```

### 3. **Flexible Containers**
```css
.container-fluid {
    padding-left: 15px;
    padding-right: 15px;
}
```

### 4. **Mobile-First Approach**
- Estilos base para mobile
- Media queries para telas maiores
- Progressive enhancement

### 5. **Overflow Control**
```css
body {
    overflow-x: hidden;
    width: 100%;
}
```

## 🎨 Classes Utilitárias Adicionadas

### Flex Utilities
```html
<div class="d-flex flex-wrap-mobile">
    <!-- Conteúdo -->
</div>

<div class="d-flex flex-column-mobile">
    <!-- Conteúdo -->
</div>
```

### Overflow Utilities
```html
<div class="overflow-hidden">
    <!-- Sem scroll -->
</div>

<div class="overflow-auto">
    <!-- Com scroll se necessário -->
</div>
```

### Video Container
```html
<div class="video-container">
    <iframe src="..."></iframe>
</div>
```

## 📱 Testes Recomendados

### Dispositivos para Testar
1. **Mobile**
   - iPhone SE (375px)
   - iPhone 12 Pro (390px)
   - Samsung Galaxy S20 (360px)

2. **Tablet**
   - iPad (768px)
   - iPad Pro (1024px)

3. **Desktop**
   - Laptop (1366px)
   - Desktop HD (1920px)

### Ferramentas de Teste
- Chrome DevTools (F12 → Toggle Device Toolbar)
- Firefox Responsive Design Mode
- BrowserStack (testes em dispositivos reais)

### Checklist de Teste
- [ ] Menu hamburguer funciona
- [ ] Texto não ultrapassa a tela
- [ ] Imagens não quebram o layout
- [ ] Botões são clicáveis
- [ ] Formulários são usáveis
- [ ] Scroll horizontal não aparece
- [ ] Cards não ficam cortados
- [ ] Footer está completo
- [ ] Mapa é interativo
- [ ] Vídeos se ajustam

## 🐛 Problemas Comuns e Soluções

### 1. **Scroll Horizontal Indesejado**
```css
body {
    overflow-x: hidden;
}
```

### 2. **Texto Cortado**
```css
.elemento {
    word-wrap: break-word;
    overflow-wrap: break-word;
}
```

### 3. **Imagens Grandes**
```css
img {
    max-width: 100%;
    height: auto;
}
```

### 4. **Botões Muito Pequenos**
```css
@media (max-width: 576px) {
    .btn {
        min-height: 44px; /* Tamanho mínimo para toque */
    }
}
```

### 5. **Navbar Quebrada**
```css
.navbar-collapse {
    background-color: rgba(1, 75, 160, 0.95);
    padding: 1rem;
}
```

## 🚀 Melhorias Futuras

1. **Performance**
   - Lazy loading de imagens
   - Minificação de CSS
   - Compressão de assets

2. **Acessibilidade**
   - Aumentar contraste de cores
   - Adicionar ARIA labels
   - Melhorar navegação por teclado

3. **PWA**
   - Service Worker
   - Manifest.json
   - Offline support

4. **Animações**
   - Transições suaves
   - Loading states
   - Skeleton screens

## 📚 Recursos Úteis

- [Bootstrap Docs](https://getbootstrap.com/docs/5.3/layout/breakpoints/)
- [Tailwind Responsive](https://tailwindcss.com/docs/responsive-design)
- [MDN Media Queries](https://developer.mozilla.org/pt-BR/docs/Web/CSS/Media_Queries)
- [Can I Use](https://caniuse.com/) - Compatibilidade de CSS

## ✅ Conclusão

O arquivo `responsive-fixes.css` foi criado para corrigir problemas de responsividade em todo o site. Ele é carregado automaticamente no layout principal e não requer configuração adicional.

**Importante**: Sempre teste em dispositivos reais além do DevTools!