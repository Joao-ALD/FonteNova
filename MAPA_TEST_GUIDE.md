# 🗺️ Guia de Teste: Mapa Interativo na Home

## Status Atual ✓
- **Routes**: ✓ Configuradas (`/` e `/mapa/info/{estado}`)
- **Controller**: ✓ Implementado com `getEstadoInfo($estado)`
- **View Home**: ✓ Atualizada com JS mejorado
- **CSS**: ✓ Corrigido e otimizado
- **Biblioteca jVectorMap**: ✓ Carregada via CDN

## Como Testar

### 1. Iniciar o Servidor Laravel
```bash
php artisan serve
```

### 2. Abrir no Navegador
- URL: `http://localhost:8000`
- Pressione F12 para abrir DevTools (Console)

### 3. Verificar o Console para Mensagens de Debug
Você deve ver mensagens como:
```
=== Iniciando renderização do mapa ===
jVectorMap disponível? true
Container existe? true
Container altura: 500
Mapa br_mill disponível? true
Renderizando mapa com jVectorMap...
✓ Mapa renderizado com sucesso!
```

### 4. Testar Interatividade
1. **Localize o Mapa**: Deve estar na seção azul "Mapa do Conhecimento" (após a Galeria Interativa)
2. **Passe o Mouse**: Os estados devem mudar de cor ao passar o mouse (hover)
3. **Clique em um Estado**: Ao clicar, deve aparecer um card branco no canto superior direito do mapa com:
   - Nome do estado
   - Descrição da iniciativa regional

### 5. Testar em Mobile
- Redimensione o navegador para simular dispositivo móvel
- O card deve aparecer e o mapa deve ser responsivo

## Se o Mapa Não Aparecer

### Checklist de Diagnóstico

1. **Console não mostra "✓ Mapa renderizado"?**
   - Verifique se há erros no console do navegador
   - Procure por mensagens de erro relacionadas a jVectorMap

2. **Mensagem "Container não encontrado"?**
   - Limpe o cache: `php artisan view:clear`
   - Reinicie o servidor

3. **Mensagem "jVectorMap não disponível"?**
   - Verifique a conexão de internet (CDN requer acesso externo)
   - Verificar se há bloqueio de CORS

4. **Vê o container mas sem mapa?**
   - Pode ser problema com jVectorMap não carregando corretamente
   - Tente instalar localmente em vez de CDN

## Estrutura de Arquivos Envolvidos

```
resources/views/
├── home.blade.php (✓ Com script jVectorMap)
├── layouts/
│   └── main.blade.php (✓ Com jQuery carregado)
└── mapa.blade.php (View separada - não usada na home)

public/assets/
├── css/
│   ├── home.css (✓)
│   └── mapa.css (✓ Atualizado)
└── js/
    └── (mapa.js é referenciado mas não usado na home)

app/Http/Controllers/
└── MapaController.php (✓ Com getEstadoInfo)

routes/
└── web.php (✓ Rotas configuradas)
```

## Logs de Sucesso

Após clicar em um estado (ex: São Paulo), você deve ver no console:
```
Estado clicado: BR-SP
GET /mapa/info/SP 200
Resposta recebida: {
  "nome": "São Paulo",
  "iniciativas": "Programa de recuperação de mananciais da Cantareira."
}
```

E o card deve desaparecer/aparecer suavemente.

---

## Próximas Etapas (Se Tudo Estiver Funcionando)

1. ✓ Mapa visível e interativo na home
2. [ ] Criar modelo `Estado` para dados dinâmicos
3. [ ] APIs RESTful para o mapa
4. [ ] Adicionar filtros (tipo, status, período)
5. [ ] Gráficos e estatísticas
6. [ ] Documentação completa

---

**Data de Atualização**: 10/11/2025
**Branch**: `feat-interactive-map-api`
**Tester**: Verifique o console do navegador!
