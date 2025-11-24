/**
 * Script de Navegação do Leitor de E-Books
 * Gerencia a exibição de páginas, navegação por botões, links numerados e teclado
 */

document.addEventListener('DOMContentLoaded', function() {
    // Elementos do DOM
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const currentPageSpan = document.getElementById('current-page-num');
    const pageLinks = document.querySelectorAll('.page-link-num');
    const pages = document.querySelectorAll('.ebook-page');
    
    // Estado da navegação
    let currentPage = 1;
    const totalPages = pages.length;
    
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
        });
        
        // Mostrar página solicitada
        const targetPage = document.getElementById(`page-${pageNumber}`);
        if (targetPage) {
            targetPage.style.display = 'block';
            // Scroll para o topo da página
            window.scrollTo(0, 0);
        }
        
        // Atualizar estado
        currentPage = pageNumber;
        updateUIState();
    }
    
    /**
     * Atualiza o estado dos botões e indicadores
     */
    function updateUIState() {
        // Atualizar indicador de página atual
        if (currentPageSpan) {
            currentPageSpan.textContent = currentPage;
        }
        
        // Ativar/Desativar botão anterior
        if (prevBtn) {
            prevBtn.disabled = currentPage === 1;
        }
        
        // Ativar/Desativar botão próximo
        if (nextBtn) {
            nextBtn.disabled = currentPage === totalPages;
        }
        
        // Atualizar links de navegação numérica
        pageLinks.forEach((link, index) => {
            const pageNum = index + 1;
            const navItem = link.closest('.page-item');
            
            if (pageNum === currentPage) {
                link.classList.add('active');
                if (navItem) navItem.classList.add('active');
            } else {
                link.classList.remove('active');
                if (navItem) navItem.classList.remove('active');
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
    
    // Event Listeners para botões
    if (prevBtn) {
        prevBtn.addEventListener('click', previousPage);
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', nextPage);
    }
    
    // Event Listeners para links numerados de páginas
    pageLinks.forEach((link, index) => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const pageNum = parseInt(this.getAttribute('data-page'));
            showPage(pageNum);
        });
    });
    
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
    
    // Inicializar: mostrar primeira página
    showPage(1);
});
