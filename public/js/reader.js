/**
 * Script de Navegação do Leitor de E-Books
 * Gerencia a exibição de páginas, navegação por botões, links numerados e teclado
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const readerContainer = document.getElementById('reader-container');
    const themeToggle = document.getElementById('theme-toggle');
    const progressBar = document.getElementById('progress-bar');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const currentPageSpan = document.getElementById('current-page-num');
    const pageDots = document.querySelectorAll('.dot');
    const pages = document.querySelectorAll('.ebook-page');
    
    // Estado da navegação
    let currentPage = 1;
    const totalPages = pages.length;
    
    // ========== INICIALIZAÇÃO ==========
    
    /**
     * Inicializa o tema (modo escuro/claro)
     */
    function initTheme() {
        const savedTheme = localStorage.getItem('ebook-theme') || 'light';
        applyTheme(savedTheme);
    }
    
    /**
     * Aplica o tema
     */
    function applyTheme(theme) {
        if (theme === 'dark') {
            readerContainer.setAttribute('data-theme', 'dark');
            themeToggle.classList.add('active');
            themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
            localStorage.setItem('ebook-theme', 'dark');
        } else {
            readerContainer.removeAttribute('data-theme');
            themeToggle.classList.remove('active');
            themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
            localStorage.setItem('ebook-theme', 'light');
        }
    }
    
    /**
     * Alterna tema
     */
    function toggleTheme() {
        const currentTheme = localStorage.getItem('ebook-theme') || 'light';
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        applyTheme(newTheme);
    }
    
    // ========== NAVEGAÇÃO DE PÁGINAS ==========
    
    /**
     * Exibe a página especificada e oculta as outras
     */
    function showPage(pageNumber) {
        // Validar número da página
        if (pageNumber < 1 || pageNumber > totalPages) {
            return;
        }
        
        // Ocultar todas as páginas
        pages.forEach(page => {
            page.style.display = 'none';
            page.classList.remove('active');
        });
        
        // Mostrar página solicitada
        const targetPage = document.getElementById(`page-${pageNumber}`);
        if (targetPage) {
            targetPage.style.display = 'block';
            targetPage.classList.add('active');
            // Scroll para o topo da página
            window.scrollTo(0, 0);
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
        // Atualizar indicador de página atual
        if (currentPageSpan) {
            currentPageSpan.textContent = currentPage;
        }
        
        // Atualizar barra de progresso
        const progress = (currentPage / totalPages) * 100;
        if (progressBar) {
            progressBar.style.width = progress + '%';
        }
        
        // Ativar/Desativar botão anterior
        if (prevBtn) {
            prevBtn.disabled = currentPage === 1;
        }
        
        // Ativar/Desativar botão próximo
        if (nextBtn) {
            nextBtn.disabled = currentPage === totalPages;
        }
        
        // Atualizar dots de navegação
        pageDots.forEach((dot, index) => {
            const pageNum = index + 1;
            if (pageNum === currentPage) {
                dot.setAttribute('aria-current', 'page');
            } else {
                dot.removeAttribute('aria-current');
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
        const ebookId = window.location.pathname.split('/')[2]; // Extrai ID da URL
        localStorage.setItem(`ebook-${ebookId}-page`, currentPage);
    }
    
    /**
     * Carrega o progresso salvo
     */
    function loadSavedProgress() {
        const ebookId = window.location.pathname.split('/')[2];
        const savedPage = localStorage.getItem(`ebook-${ebookId}-page`);
        if (savedPage) {
            const pageNum = Math.min(parseInt(savedPage), totalPages);
            showPage(pageNum);
            return;
        }
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
    pageDots.forEach((dot, index) => {
        dot.addEventListener('click', function(e) {
            e.preventDefault();
            const pageNum = parseInt(this.getAttribute('data-page'));
            showPage(pageNum);
        });
    });
    
    // Botão de tema
    if (themeToggle) {
        themeToggle.addEventListener('click', toggleTheme);
    }
    
    // Navegação por teclado
    document.addEventListener('keydown', function(event) {
        // ArrowLeft = página anterior
        if (event.key === 'ArrowLeft' || event.key === 'ArrowUp') {
            previousPage();
        }
        // ArrowRight = próxima página
        else if (event.key === 'ArrowRight' || event.key === 'ArrowDown') {
            nextPage();
        }
        // Home = primeira página
        else if (event.key === 'Home') {
            showPage(1);
        }
        // End = última página
        else if (event.key === 'End') {
            showPage(totalPages);
        }
    });
    
    // ========== INICIALIZAÇÃO FINAL ==========
    
    // Inicializar tema
    initTheme();
    
    // Carregar progresso salvo ou mostrar primeira página
    loadSavedProgress();
});
