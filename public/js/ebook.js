/**
 * Script de Navegação do Leitor de E-Books (Versão Limpa)
 * Gerencia a exibição de páginas, navegação por botões e teclado.
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // Elementos do DOM
    const progressBar = document.getElementById('progress-bar');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const currentPageSpan = document.getElementById('current-page-num');
    const pageDots = document.querySelectorAll('.dot');
    const pages = document.querySelectorAll('.ebook-page');
    
    // Estado da navegação
    // Se não houver páginas encontradas, assume 1 para evitar erros de divisão por zero
    const totalPages = pages.length || 1; 
    let currentPage = 1;
    
    // ========== NAVEGAÇÃO DE PÁGINAS ==========
    
    /**
     * Exibe a página especificada e oculta as outras
     */
    function showPage(pageNumber) {
        // Validar número da página
        if (pageNumber < 1) pageNumber = 1;
        if (pageNumber > totalPages) pageNumber = totalPages;
        
        // Ocultar todas as páginas e remover classe ativa
        pages.forEach(page => {
            page.style.display = 'none';
            page.classList.remove('active');
        });
        
        // Mostrar página solicitada
        // O seletor busca a div que tem o atributo data-page-number igual ao número atual
        const targetPage = document.querySelector(`.ebook-page[data-page-number="${pageNumber}"]`);
        
        if (targetPage) {
            targetPage.style.display = 'block';
            // Pequeno delay para garantir que o display:block foi aplicado antes da animação
            setTimeout(() => {
                targetPage.classList.add('active');
            }, 10);
            
            // Scroll suave para o topo
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        // Atualizar estado
        currentPage = pageNumber;
        updateUIState();
        saveLitProgress();
    }
    
    /**
     * Atualiza o estado dos botões e indicadores
     */
    function updateUIState() {
        // Atualizar texto do número da página
        if (currentPageSpan) {
            currentPageSpan.textContent = currentPage;
        }
        
        // Atualizar barra de progresso
        if (progressBar) {
            const progress = (currentPage / totalPages) * 100;
            progressBar.style.width = progress + '%';
        }
        
        // Ativar/Desativar botão anterior
        if (prevBtn) {
            prevBtn.disabled = (currentPage === 1);
        }
        
        // Ativar/Desativar botão próximo
        if (nextBtn) {
            nextBtn.disabled = (currentPage === totalPages);
        }
        
        // Atualizar bolinhas (dots) de navegação
        pageDots.forEach((dot) => {
            const pageNum = parseInt(dot.getAttribute('data-page'));
            if (pageNum === currentPage) {
                dot.setAttribute('aria-current', 'page');
                // Estilo direto via JS para garantir visual sem depender de classes complexas
                dot.style.backgroundColor = 'var(--primary)';
                dot.style.color = '#fff';
            } else {
                dot.removeAttribute('aria-current');
                dot.style.backgroundColor = 'transparent';
                dot.style.color = 'var(--primary-light)';
            }
        });
    }
    
    /**
     * Navegar para página anterior
     */
    function previousPage() {
        if (currentPage > 1) {
            showPage(currentPage - 1);
        }
    }
    
    /**
     * Navegar para próxima página
     */
    function nextPage() {
        if (currentPage < totalPages) {
            showPage(currentPage + 1);
        }
    }
    
    // ========== PERSISTÊNCIA DE PROGRESSO ==========
    
    /**
     * Salva o progresso da leitura no localStorage
     */
    function saveLitProgress() {
        try {
            // Tenta pegar o ID da URL (ex: /ebooks/15/reader -> pega o 15)
            const pathParts = window.location.pathname.split('/');
            // Procura onde está 'ebooks' e pega o próximo segmento
            const index = pathParts.indexOf('ebooks');
            if (index !== -1 && pathParts[index + 1]) {
                const ebookId = pathParts[index + 1];
                localStorage.setItem(`ebook-${ebookId}-page`, currentPage);
            }
        } catch (e) {
            console.warn('Não foi possível salvar o progresso localmente.');
        }
    }
    
    /**
     * Carrega o progresso salvo
     */
    function loadSavedProgress() {
        try {
            const pathParts = window.location.pathname.split('/');
            const index = pathParts.indexOf('ebooks');
            
            if (index !== -1 && pathParts[index + 1]) {
                const ebookId = pathParts[index + 1];
                const savedPage = localStorage.getItem(`ebook-${ebookId}-page`);
                
                if (savedPage) {
                    const pageNum = parseInt(savedPage);
                    // Garante que a página salva ainda é válida
                    if (pageNum > 0 && pageNum <= totalPages) {
                        showPage(pageNum);
                        return;
                    }
                }
            }
        } catch (e) {
            console.warn('Erro ao carregar progresso salvo.');
        }
        // Se falhar ou não tiver salvo, mostra a página 1
        showPage(1);
    }
    
    // ========== EVENT LISTENERS ==========
    
    // Botões de navegação
    if (prevBtn) {
        prevBtn.addEventListener('click', previousPage);
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', nextPage);
    }
    
    // Dots de navegação
    pageDots.forEach((dot) => {
        dot.addEventListener('click', function(e) {
            e.preventDefault();
            const pageNum = parseInt(this.getAttribute('data-page'));
            showPage(pageNum);
        });
    });
    
    // Navegação por teclado
    document.addEventListener('keydown', function(event) {
        if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
            previousPage();
        } else if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
            nextPage();
        } else if (event.key === 'Home') {
            showPage(1);
        } else if (event.key === 'End') {
            showPage(totalPages);
        }
    });
    
    // ========== INICIALIZAÇÃO FINAL ==========
    
    // Inicia carregando o progresso ou a página 1
    loadSavedProgress();
});