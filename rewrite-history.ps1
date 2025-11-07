# Configuração do ambiente
$env:GIT_AUTHOR_NAME_NEW = "Joao-ALD"
$env:GIT_AUTHOR_EMAIL_NEW = "joaovictorald@gmail.com"
$env:GIT_COMMITTER_NAME_NEW = "Joao-ALD"
$env:GIT_COMMITTER_EMAIL_NEW = "joaovictorald@gmail.com"

# Criar backup
Write-Host "Criando backup..."
git branch -f backup-before-rewrite

# Função para reescrever o histórico
$filterCommand = @'
if [ "$GIT_AUTHOR_EMAIL" = "161369871+google-labs-jules[bot]@users.noreply.github.com" ] || 
   [ "$GIT_AUTHOR_NAME" = "google-labs-jules[bot]" ] ||
   [ "$GIT_AUTHOR_EMAIL" = "pedrinhohneves14@gmail.com" ] ||
   [ "$GIT_AUTHOR_NAME" = "Pedro" ]; then
    export GIT_AUTHOR_NAME="$env:GIT_AUTHOR_NAME_NEW"
    export GIT_AUTHOR_EMAIL="$env:GIT_AUTHOR_EMAIL_NEW"
    export GIT_COMMITTER_NAME="$env:GIT_COMMITTER_NAME_NEW"
    export GIT_COMMITTER_EMAIL="$env:GIT_COMMITTER_EMAIL_NEW"
fi
'@

# Executar filter-branch
Write-Host "Reescrevendo histórico..."
$env:FILTER_BRANCH_SQUELCH_WARNING = "1"
git filter-branch -f --env-filter $filterCommand HEAD

# Verificar resultado
Write-Host "`nVerificando autores únicos após reescrita:"
git log --format="%aN <%aE>" | Sort-Object -Unique

Write-Host "`nPróximos passos:"
Write-Host "1. Verifique se os autores foram corretamente alterados"
Write-Host "2. Se estiver satisfeito, use 'git push --force origin main'"
Write-Host "3. Se algo deu errado, use 'git reset --hard backup-before-rewrite'"