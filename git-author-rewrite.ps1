[CmdletBinding()]
param(
    [Parameter(Mandatory = $false)]
    [string]$NewAuthorName = "New Author",
    
    [Parameter(Mandatory = $false)]
    [string]$NewAuthorEmail = "new.author@example.com",
    
    [Parameter(Mandatory = $false)]
    [string[]]$OldEmails = @(),
    
    [Parameter(Mandatory = $false)]
    [string[]]$OldNames = @(),
    
    [Parameter(Mandatory = $false)]
    [switch]$ListAuthors,
    
    [Parameter(Mandatory = $false)]
    [switch]$Help
)

# Função para mostrar ajuda
function Show-Help {
    Write-Host @"
Git Author Rewrite Script
------------------------
Este script permite reescrever o histórico do Git alterando autores específicos para um novo autor.

Uso:
    .\git-author-rewrite.ps1 [-NewAuthorName <nome>] [-NewAuthorEmail <email>] 
                            [-OldEmails <email1,email2>] [-OldNames <nome1,nome2>]
                            [-ListAuthors] [-Help]

Parâmetros:
    -NewAuthorName    Nome do novo autor (default: "New Author")
    -NewAuthorEmail   Email do novo autor (default: "new.author@example.com")
    -OldEmails        Lista de emails antigos para substituir (separados por vírgula)
    -OldNames         Lista de nomes antigos para substituir (separados por vírgula)
    -ListAuthors      Apenas lista os autores atuais sem fazer alterações
    -Help             Mostra esta mensagem de ajuda

Exemplos:
    # Listar todos os autores atuais
    .\git-author-rewrite.ps1 -ListAuthors

    # Substituir autores específicos
    .\git-author-rewrite.ps1 -NewAuthorName "John Doe" -NewAuthorEmail "john@example.com" `
                            -OldEmails "old1@mail.com","old2@mail.com" `
                            -OldNames "OldName1","OldName2"

"@
    exit
}

# Mostrar ajuda se solicitado
if ($Help) {
    Show-Help
}

# Função para listar autores únicos
function Get-UniqueAuthors {
    Write-Host "`nAutores únicos no repositório:"
    Write-Host "-----------------------------"
    git log --format="%aN <%aE>" | Sort-Object -Unique
}

# Se -ListAuthors foi especificado, apenas mostra os autores e sai
if ($ListAuthors) {
    Get-UniqueAuthors
    exit
}

# Validar se temos pelo menos um email ou nome antigo para substituir
if ($OldEmails.Count -eq 0 -and $OldNames.Count -eq 0) {
    Write-Host "ERRO: Você deve especificar pelo menos um email (-OldEmails) ou nome (-OldNames) para substituir." -ForegroundColor Red
    Write-Host "Use -Help para ver as instruções de uso." -ForegroundColor Yellow
    exit 1
}

# Criar backup
Write-Host "`nCriando backup do estado atual..." -ForegroundColor Cyan
git branch -f backup-before-rewrite

# Construir a condição do filtro
$conditions = @()
foreach ($email in $OldEmails) {
    $conditions += '[ "$GIT_AUTHOR_EMAIL" = "' + $email + '" ]'
}
foreach ($name in $OldNames) {
    $conditions += '[ "$GIT_AUTHOR_NAME" = "' + $name + '" ]'
}

$filterCondition = $conditions -join ' || '

# Construir o comando de filtro
$filterCommand = @"
if $filterCondition; then
    export GIT_AUTHOR_NAME="$NewAuthorName"
    export GIT_AUTHOR_EMAIL="$NewAuthorEmail"
    export GIT_COMMITTER_NAME="$NewAuthorName"
    export GIT_COMMITTER_EMAIL="$NewAuthorEmail"
fi
"@

# Executar filter-branch
Write-Host "`nReescrevendo histórico..." -ForegroundColor Cyan
Write-Host "Substituindo autores antigos por: $NewAuthorName <$NewAuthorEmail>" -ForegroundColor Yellow
$env:FILTER_BRANCH_SQUELCH_WARNING = "1"
git filter-branch -f --env-filter $filterCommand HEAD

# Mostrar resultado
Write-Host "`nVerificando autores únicos após a reescrita:" -ForegroundColor Green
Get-UniqueAuthors

Write-Host "`nPróximos passos:" -ForegroundColor Cyan
Write-Host "1. Verifique se os autores foram corretamente alterados" -ForegroundColor Yellow
Write-Host "2. Se estiver satisfeito, use 'git push --force origin main'" -ForegroundColor Yellow
Write-Host "3. Se algo deu errado, use 'git reset --hard backup-before-rewrite'" -ForegroundColor Yellow

Write-Host "`nNOTA: Após fazer push forçado, outros colaboradores precisarão fazer novo clone ou reset de seus repositórios locais." -ForegroundColor Magenta