# 📋 Instruções para Gerenciamento de Iniciativas

## 🧹 Limpeza e População Inicial

### Para limpar dados antigos e inserir dados reais:
```bash
# 1. Limpar iniciativas existentes
php artisan db:seed --class=LimparIniciativasSeeder

# 2. Inserir dados reais
php artisan db:seed --class=IniciativaRealSeeder
```

## 👥 Para a Equipe - Adicionando Dados de Teste

### Gerar iniciativas de exemplo (usando factories):
```bash
php artisan db:seed --class=IniciativaSeeder
```

### Adicionar apenas estados (se necessário):
```bash
php artisan db:seed --class=EstadoSeeder
```

## 📝 Seeders Disponíveis

- **`EstadoSeeder`** - Popula todos os estados brasileiros
- **`IniciativaSeeder`** - Gera iniciativas de exemplo (para testes)
- **`IniciativaRealSeeder`** - Insere iniciativas reais com links
- **`LimparIniciativasSeeder`** - Limpa apenas a tabela de iniciativas

## 🔄 Reset Completo (cuidado!)
```bash
# Limpa TUDO e recria com dados reais
php artisan migrate:fresh --seed --seeder=DatabaseSeederReal
```

## ✅ Verificar Dados
```bash
# Ver quantas iniciativas existem
php artisan tinker
>>> App\Models\Iniciativa::count()
>>> App\Models\Estado::count()
```