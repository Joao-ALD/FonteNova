# 📚 Explicações Técnicas - Projeto FonteNova

## 🗺️ Sistema de Mapa Interativo

### Como o Sistema Puxa os Dados Reais

#### 1. **Fluxo Completo dos Dados**

```
Banco de Dados → Model → Controller → API → JavaScript → Interface
```

#### 2. **Armazenamento (Banco de Dados)**

Os dados reais ficam na tabela `iniciativas`:
```sql
-- Estrutura da tabela
iniciativas:
- id, estado_id, titulo, descricao, tipo, status
- investimento, latitude, longitude, link_externo
```

#### 3. **Inserção dos Dados (Seeders)**

**`IniciativaRealSeeder.php`** insere dados reais:
```php
'SP' => [
    [
        'titulo' => 'Sistema Cantareira',
        'descricao' => 'Maior sistema de abastecimento...',
        'tipo' => 'água',
        'link_externo' => 'https://www.sabesp.com.br/cantareira'
    ]
]
```

#### 4. **Recuperação dos Dados (Model + Controller)**

**`MapaController.php`**:
```php
public function getEstadoInfo($estado)
{
    // 1. Busca o estado pela sigla (ex: 'SP')
    $estadoModel = Estado::where('sigla', strtoupper($estado))->first();
    
    // 2. Busca as iniciativas desse estado
    $iniciativas = $estadoModel->iniciativas()
        ->get(['titulo', 'descricao', 'tipo', 'status', 'link_externo'])
        ->toArray();
    
    // 3. Retorna JSON
    return response()->json([
        'nome' => $estadoModel->nome,
        'iniciativas' => $iniciativas
    ]);
}
```

#### 5. **Rota da API**

**`web.php`**:
```php
Route::get('/mapa/info/{estado}', [MapaController::class, 'getEstadoInfo']);
```

#### 6. **Consumo pelo JavaScript**

**`home.blade.php`**:
```javascript
// Quando clica no estado 'SP'
$.ajax({
    url: '/mapa/info/SP',  // Chama a API
    success: function(response) {
        // response = {
        //   "nome": "São Paulo",
        //   "iniciativas": [
        //     {
        //       "titulo": "Sistema Cantareira",
        //       "descricao": "Maior sistema...",
        //       "tipo": "água",
        //       "link_externo": "https://..."
        //     }
        //   ]
        // }
    }
});
```

#### 7. **Exibição na Interface**

O JavaScript processa o JSON e cria HTML:
```javascript
response.iniciativas.forEach(function(iniciativa) {
    html += '<div>' + iniciativa.titulo + '</div>';
    html += '<a href="' + iniciativa.link_externo + '">🔗 Saiba mais</a>';
});
```

#### 8. **Relacionamento entre Tabelas**

```php
// Model Estado.php
public function iniciativas() {
    return $this->hasMany(Iniciativa::class);
}

// Model Iniciativa.php  
public function estado() {
    return $this->belongsTo(Estado::class);
}
```

#### 9. **Exemplo Prático**

1. **Usuário clica** em São Paulo no mapa
2. **JavaScript** faz requisição: `GET /mapa/info/SP`
3. **Controller** busca: `Estado::where('sigla', 'SP')`
4. **Eloquent** retorna: São Paulo + suas iniciativas
5. **API** responde: JSON com dados reais
6. **JavaScript** renderiza: HTML com links clicáveis

#### 10. **Dados Reais vs Lorem**

- **Antes**: Factory gerava textos aleatórios (lorem ipsum)
- **Agora**: Seeder insere dados reais de projetos brasileiros
- **Resultado**: Mapa mostra Sistema Cantareira, Baía de Guanabara, etc.

O sistema é **100% dinâmico** - os dados vêm do banco, não estão hardcoded no código!

---

## 🤖 Sistema de ChatBot

### Como o ChatBot Funciona

#### 1. **Fluxo Completo do ChatBot**

```
Usuário digita → JavaScript → Controller → Busca no BD → Resposta JSON → Interface
```

#### 2. **Armazenamento (Banco de Dados)**

Os dados ficam na tabela `topicos`:
```sql
-- Estrutura da tabela
topicos:
- id, nome, palavras_chave, resumo
- link_site, link_premium
```

#### 3. **Model Topico**

**`Topico.php`**:
```php
class Topico extends Model
{
    protected $fillable = [
        'nome',
        'palavras_chave',    // CSV: "agua,chuva,economia"
        'resumo',           // Resposta do bot
        'link_site',        // Link para mais info
        'link_premium'      // Link premium (opcional)
    ];
}
```

#### 4. **Controller do ChatBot**

**`ChatBotController.php`**:

##### **Método index()** - Exibe a interface
```php
public function index()
{
    return view('chatbot');
}
```

##### **Método responder()** - Processa perguntas
```php
public function responder(Request $request)
{
    // 1. Valida entrada
    $data = $request->validate([
        'mensagem' => 'required|string|max:500'
    ]);

    // 2. Normaliza texto (remove acentos)
    $mensagem = self::normalizarTexto($data['mensagem']);

    // 3. Busca em todos os tópicos
    $topicos = Topico::all();
    
    // 4. Sistema de pontuação por palavra-chave
    foreach ($topicos as $topico) {
        $pontuacao = 0;
        $keywords = explode(',', $topico->palavras_chave);
        
        foreach ($keywords as $kw) {
            if (strpos($mensagem, trim($kw)) !== false) {
                $pontuacao++;
            }
        }
        
        // Guarda o tópico com maior pontuação
    }

    // 5. Retorna resposta JSON
    return response()->json([
        'success' => true,
        'data' => [
            'titulo' => $topico->nome,
            'resumo' => $topico->resumo,
            'link_site' => $topico->link_site,
            'link_premium' => $topico->link_premium
        ]
    ]);
}
```

#### 5. **Normalização de Texto**

**Função `normalizarTexto()`**:
```php
private static function normalizarTexto($texto)
{
    // 1. Converte para minúsculas
    $texto = mb_strtolower($texto, 'UTF-8');
    
    // 2. Remove acentos
    $texto = iconv('UTF-8', 'ASCII//TRANSLIT', $texto);
    
    // 3. Substitui caracteres especiais
    $texto = preg_replace('/[áàãâä]/u','a',$texto);
    $texto = preg_replace('/[éèêë]/u','e',$texto);
    // ... outros caracteres
    
    // 4. Remove caracteres especiais
    $texto = preg_replace('/[^a-z0-9\s,]/i', ' ', $texto);
    
    return trim($texto);
}
```

#### 6. **Interface do ChatBot**

**`chatbot.blade.php`**:

##### **HTML da Interface**
```html
<!-- Campo de entrada -->
<form id="chat-form">
    <input type="text" id="mensagem" placeholder="Digite sua pergunta...">
    <button type="submit">Enviar</button>
</form>

<!-- Sugestões rápidas -->
<button class="sugestao">Como reutilizar água da chuva?</button>
<button class="sugestao">Como diminuir a conta de água?</button>

<!-- Área de resposta -->
<div id="resposta" class="d-none"></div>
```

##### **JavaScript da Interface**
```javascript
async function enviarMensagem() {
    const msg = document.getElementById('mensagem').value;
    
    // 1. Faz requisição AJAX
    const res = await fetch('/chatbot/responder', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ mensagem: msg })
    });
    
    // 2. Processa resposta
    const data = await res.json();
    
    // 3. Exibe na interface
    document.getElementById('resposta').innerHTML = `
        <p>${data.data.resumo}</p>
        <a href="${data.data.link_site}">Saiba mais</a>
    `;
}
```

#### 7. **Sistema de Busca por Palavras-Chave**

##### **Exemplo de Tópico no Banco**
```sql
INSERT INTO topicos VALUES (
    1,
    'Economia de Água',
    'economia,agua,conta,diminuir,reduzir,economizar',
    'Para economizar água, você pode: reutilizar água da chuva, consertar vazamentos...',
    '/infoAgua',
    '/curso'
);
```

##### **Como a Busca Funciona**
1. **Usuário pergunta**: "Como diminuir a conta de água?"
2. **Normalização**: "como diminuir a conta de agua"
3. **Busca palavras-chave**: encontra "diminuir" e "agua"
4. **Pontuação**: 2 pontos para este tópico
5. **Resposta**: Retorna o tópico com maior pontuação

#### 8. **Exemplo Prático Completo**

1. **Usuário digita**: "Quero economizar água em casa"
2. **JavaScript** envia: `POST /chatbot/responder`
3. **Controller** normaliza: "quero economizar agua em casa"
4. **Busca** encontra palavras: "economizar" + "agua"
5. **Retorna** tópico sobre economia de água
6. **Interface** exibe: resumo + links

#### 9. **Tratamento de Erros**

```php
// Se nenhum tópico for encontrado
return response()->json([
    'success' => true,
    'data' => [
        'titulo' => 'Tópico não encontrado',
        'resumo' => 'Não encontrei nada sobre isso ainda.',
        'link_site' => '/infoAgua',
        'link_premium' => null
    ]
]);
```

#### 10. **Vantagens do Sistema**

- **Flexível**: Fácil adicionar novos tópicos
- **Inteligente**: Sistema de pontuação por relevância
- **Robusto**: Normalização de texto para melhor matching
- **Extensível**: Pode evoluir para IA mais complexa
- **Seguro**: Validação e escape de dados

---

## 💧 Sistema de Informações sobre Água

### Como Funciona a Página "Sobre a Água"

#### 1. **Estrutura de Dados**

**`AguaController.php`** contém dados estruturados sobre água:
```php
public function index()
{
    $topics = [
        "Clima" => [
            [
                "title" => "Chuvas",
                "text" => "As chuvas são fundamentais...",
                "image" => "chuvas.png"
            ]
        ],
        "Coleta" => [...],
        "Consumo" => [...],
        "Preservacao" => [...]
    ];
    
    return view('agua', compact('topics'));
}
```

#### 2. **Categorias de Conteúdo**

- **🌍 Clima**: Chuvas, Secas, Temperatura, Eventos Extremos
- **💧 Coleta**: Captação de Chuva, Águas Subterrâneas, Rios
- **🚰 Consumo**: Doméstico, Agrícola, Industrial, Energia
- **🌱 Preservação**: Educação, Legislação, Reflorestamento

#### 3. **Fluxo de Dados**

```
Controller → Array de Tópicos → View → Interface Organizada
```

#### 4. **Características**

- **Conteúdo Educativo**: Textos informativos sobre sustentabilidade
- **Organização Temática**: 4 grandes categorias
- **Interface Responsiva**: Adaptada para diferentes dispositivos
- **Imagens Ilustrativas**: Cada tópico tem sua imagem

---

## 🎓 Sistema de Cursos

### Como Funciona o Sistema de Aulas

#### 1. **Estrutura do Banco de Dados**

**Tabela `aulas`**:
```sql
aulas:
- id, titulo, descricao_html, video_embed_url
- ordem, created_at, updated_at
```

#### 2. **Model Aula**

**`Aula.php`**:
```php
class Aula extends Model
{
    protected $fillable = [
        'titulo',
        'descricao_html',    // Conteúdo HTML da aula
        'video_embed_url',   // URL do vídeo (YouTube, etc.)
        'ordem',            // Ordem de exibição
    ];
}
```

#### 3. **Controller do Curso**

**`CursoController.php`**:

##### **Método index()** - Lista todas as aulas
```php
public function index()
{
    // Busca aulas ordenadas
    $aulas = Aula::orderBy('ordem', 'asc')->get();
    
    return view('cursos.index', ['aulas' => $aulas]);
}
```

##### **Método mostrarAula()** - Exibe aula específica
```php
public function mostrarAula(Aula $aula)
{
    $aulas = Aula::orderBy('ordem', 'asc')->get();
    
    // Lógica de navegação (anterior/próxima)
    $currentIndex = $aulas->search(fn($item) => $item->id == $aula->id);
    $aulaAnterior = $aulas->get($currentIndex - 1);
    $proximaAula = $aulas->get($currentIndex + 1);
    
    return view('cursos.aula', [
        'aulas' => $aulas,
        'aulaAtiva' => $aula,
        'aulaAnterior' => $aulaAnterior,
        'proximaAula' => $proximaAula
    ]);
}
```

#### 4. **Sistema de Navegação**

- **Lista de Aulas**: Sidebar com todas as aulas
- **Navegação Sequencial**: Botões anterior/próxima
- **Ordem Personalizada**: Campo `ordem` define sequência
- **Injeção de Dependência**: Laravel injeta automaticamente a aula pela URL

#### 5. **Rotas do Curso**

```php
// Lista de aulas
Route::get('/curso', [CursoController::class, 'index']);

// Aula específica
Route::get('/cursos/{aula}', [CursoController::class, 'mostrarAula']);
```

#### 6. **Características**

- **Conteúdo Multimídia**: Vídeos + texto HTML
- **Navegação Intuitiva**: Fácil ir para próxima/anterior
- **Ordem Flexível**: Administrador define sequência
- **Proteção por Login**: Apenas usuários autenticados

---

## 🧩 Sistema de Quiz

### Como Funciona o Quiz Interativo

#### 1. **Estrutura do Banco de Dados**

**Tabela `pergunta_quiz`**:
```sql
pergunta_quiz:
- id, pergunta, opcao_a, opcao_b, opcao_c
- resposta_correta, litros_economizados, ordem
```

#### 2. **Model PerguntaQuiz**

**`PerguntaQuiz.php`**:
```php
class PerguntaQuiz extends Model
{
    protected $table = 'pergunta_quiz';
    
    protected $fillable = [
        'pergunta', 'opcao_a', 'opcao_b', 'opcao_c',
        'resposta_correta', 'litros_economizados', 'ordem'
    ];
    
    // Accessor para formatar dados em JSON
    public function getJsonDataAttribute()
    {
        return [
            'question' => $this->pergunta,
            'a' => $this->opcao_a,
            'b' => $this->opcao_b,
            'c' => $this->opcao_c,
            'correct' => $this->resposta_correta,
            'liters' => $this->litros_economizados,
        ];
    }
}
```

#### 3. **Controller do Quiz**

**`QuizzController.php`**:
```php
public function index()
{
    // Busca perguntas ordenadas
    $perguntas = PerguntaQuiz::orderBy('ordem', 'asc')->get();
    
    // Passa para a view
    return view('quizz', ['perguntas' => $perguntas]);
}
```

#### 4. **Fluxo Completo**

```
Banco de Dados → Controller → View → JavaScript → Interface Interativa
```

1. **Backend**: Busca perguntas do banco
2. **View**: Recebe array de perguntas
3. **JavaScript**: Processa e exibe dinamicamente
4. **Usuário**: Responde e vê resultado

#### 5. **Sistema de Pontuação**

- **Perguntas Dinâmicas**: Vêm do banco de dados
- **Cálculo de Economia**: Campo `litros_economizados`
- **Ordem Personalizada**: Campo `ordem` define sequência
- **Resultado Educativo**: Mostra impacto das escolhas

#### 6. **Características**

- **Dinâmico**: Perguntas gerenciadas pelo admin
- **Educativo**: Ensina sobre economia de água
- **Interativo**: Interface com JavaScript
- **Gamificação**: Incentiva melhores práticas

---

## 📚 Sistema de Ebooks

### Como Funciona a Biblioteca Digital

#### 1. **Estrutura do Banco de Dados**

**Tabela `ebooks`**:
```sql
ebooks:
- id, title, slug, cover_path, short_description
- created_at, updated_at
```

**Tabela `ebook_pages`**:
```sql
ebook_pages:
- id, ebook_id, page_number, content
- created_at, updated_at
```

#### 2. **Models e Relacionamentos**

**`Ebook.php`**:
```php
class Ebook extends Model
{
    protected $fillable = ['title', 'slug', 'cover_path', 'short_description'];
    
    // Um ebook tem muitas páginas
    public function pages(): HasMany
    {
        return $this->hasMany(EbookPage::class)->orderBy('page_number');
    }
}
```

**`EbookPage.php`**:
```php
class EbookPage extends Model
{
    protected $fillable = ['ebook_id', 'page_number', 'content'];
    
    // Uma página pertence a um ebook
    public function ebook(): BelongsTo
    {
        return $this->belongsTo(Ebook::class);
    }
}
```

#### 3. **Controller do Ebook**

**`EbookController.php`**:

##### **Método index()** - Biblioteca
```php
public function index()
{
    // Lista todos os ebooks
    $ebooks = Ebook::orderBy('created_at', 'desc')->get();
    return view('ebooks.index', compact('ebooks'));
}
```

##### **Método reader()** - Leitor
```php
public function reader($id)
{
    // Eager Loading: carrega ebook + páginas de uma vez
    $ebook = Ebook::with('pages')->findOrFail($id);
    return view('ebooks.reader', compact('ebook'));
}
```

##### **Método generateCover()** - Capa Dinâmica
```php
public function generateCover($id)
{
    $ebook = Ebook::findOrFail($id);
    
    // 1. Tenta servir imagem local primeiro
    if (!empty($ebook->cover_path) && file_exists(public_path($ebook->cover_path))) {
        return response()->file(public_path($ebook->cover_path));
    }
    
    // 2. Gera SVG dinâmico se não houver imagem
    $svg = "<!-- SVG com gradientes e design profissional -->";
    return response($svg)->header('Content-Type', 'image/svg+xml');
}
```

#### 4. **Sistema de Capas Dinâmicas**

**Características**:
- **Prioridade**: Imagem local → SVG gerado
- **Temas**: 6 gradientes diferentes baseados no ID
- **Elementos**: Gradientes, círculos decorativos, emojis
- **Cache**: Headers de cache para performance

**Seleção de Tema**:
```php
$themes = [
    ['gradient1' => '#4a90e2', 'icon' => '💧'],
    ['gradient1' => '#2ecc71', 'icon' => '🌍'],
    // ... 4 temas adicionais
];
$theme = $themes[$id % count($themes)];
```

#### 5. **Fluxo de Leitura**

```
Biblioteca → Seleção → Leitor → Navegação por Páginas
```

1. **Biblioteca**: Grid com todos os ebooks
2. **Capa**: SVG dinâmico ou imagem local
3. **Leitor**: Interface tipo livro digital
4. **Páginas**: Conteúdo HTML ordenado

#### 6. **Características**

- **Eager Loading**: Otimização de queries
- **Capas Dinâmicas**: SVG gerado automaticamente
- **Conteúdo HTML**: Suporta formatação rica
- **Ordenação**: Páginas sempre em ordem
- **Responsivo**: Funciona em todos os dispositivos

---

## 🛠️ Painel Administrativo

### Sistema de Gerenciamento Admin

#### 1. **AdminQuizzController**

**Funcionalidades CRUD**:
```php
class AdminQuizzController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Proteção dupla
    }
    
    // Listar perguntas
    public function index()
    {
        $perguntas = PerguntaQuiz::orderBy('ordem', 'asc')->get();
        return view('admin.quizz.index', compact('perguntas'));
    }
    
    // Criar nova pergunta
    public function create()
    {
        return view('admin.quizz.create');
    }
    
    // Salvar pergunta
    public function store(Request $request)
    {
        $request->validate([
            'pergunta' => 'required|string|max:500',
            'opcao_a' => 'required|string|max:255',
            'opcao_b' => 'required|string|max:255',
            'opcao_c' => 'required|string|max:255',
            'resposta_correta' => 'required|in:a,b,c',
            'litros_economizados' => 'required|integer|min:0',
            'ordem' => 'required|integer|min:1|unique:pergunta_quiz,ordem',
        ]);
        
        PerguntaQuiz::create($request->all());
        return redirect()->route('admin.quizz.index')
            ->with('success', 'Pergunta criada!');
    }
    
    // Editar pergunta
    public function edit(PerguntaQuiz $pergunta)
    {
        return view('admin.quizz.edit', compact('pergunta'));
    }
    
    // Atualizar pergunta
    public function update(Request $request, PerguntaQuiz $pergunta)
    {
        $request->validate([/* validações */]);
        $pergunta->update($request->all());
        return redirect()->route('admin.quizz.index')
            ->with('success', 'Pergunta atualizada!');
    }
    
    // Deletar pergunta
    public function destroy(PerguntaQuiz $pergunta)
    {
        $pergunta->delete();
        return redirect()->route('admin.quizz.index')
            ->with('success', 'Pergunta excluída!');
    }
}
```

#### 2. **Rotas Administrativas**

```php
// Grupo protegido por auth + admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Gerenciamento de Cursos
    Route::get('/cursos', [CursoController::class, 'adminIndex']);
    Route::get('/cursos/{id}/editar', [CursoController::class, 'edit']);
    Route::put('/cursos/{id}', [CursoController::class, 'update']);
    
    // Gerenciamento de Quiz (Resource completo)
    Route::resource('quizz', AdminQuizzController::class)
        ->names('admin.quizz')
        ->parameters(['quizz' => 'pergunta'])
        ->except(['show']);
});
```

#### 3. **Validações Personalizadas**

**Ordem Única**:
```php
'ordem' => 'required|integer|min:1|unique:pergunta_quiz,ordem'
```

**Mensagens Customizadas**:
```php
[
    'ordem.unique' => 'O número de ordem já está em uso.'
]
```

#### 4. **Características do Painel**

- **CRUD Completo**: Create, Read, Update, Delete
- **Validação Robusta**: Regras de validação em todas as operações
- **Proteção Dupla**: Middleware na rota + no constructor
- **Feedback Visual**: Mensagens de sucesso/erro
- **Route Model Binding**: Laravel injeta automaticamente o model

---

## 🌐 API REST

### Sistema de API para Dados Públicos

#### 1. **Estrutura da API**

**Endpoints Disponíveis**:
```
GET /api/estados              → Lista todos os estados
GET /api/estados/{uf}         → Detalhes de um estado
GET /api/estados/{uf}/iniciativas → Iniciativas por estado
GET /api/iniciativas          → Lista todas as iniciativas
GET /api/iniciativas/search   → Busca com filtros
GET /api/estatisticas         → Estatísticas gerais
```

#### 2. **Controllers da API**

##### **EstadoController**
```php
class EstadoController extends Controller
{
    public function index()
    {
        // Cache de 60 segundos
        $estados = Cache::remember('estados_list', 60, function () {
            return Estado::all();
        });
        return EstadoResource::collection($estados);
    }
    
    public function show($uf)
    {
        $estado = Estado::where('sigla', $uf)->firstOrFail();
        return new EstadoResource($estado);
    }
}
```

##### **IniciativaController**
```php
class IniciativaController extends Controller
{
    public function index(IniciativaFilterRequest $request)
    {
        $query = Iniciativa::query();
        
        // Filtros dinâmicos
        if ($request->filled('tipo')) {
            $query->porTipo($request->tipo);
        }
        
        if ($request->filled('status')) {
            $query->porStatus($request->status);
        }
        
        if ($request->filled('q')) {
            $query->where('titulo', 'like', "%{$request->q}%")
                  ->orWhere('descricao', 'like', "%{$request->q}%");
        }
        
        return IniciativaResource::collection($query->get());
    }
    
    public function porEstado(IniciativaFilterRequest $request, $uf)
    {
        $estado = Estado::where('sigla', $uf)->firstOrFail();
        $query = $estado->iniciativas();
        
        // Aplica filtros
        if ($request->filled('tipo')) {
            $query->porTipo($request->tipo);
        }
        
        return IniciativaResource::collection($query->get());
    }
}
```

##### **EstatisticasController**
```php
class EstatisticasController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_iniciativas' => Iniciativa::count(),
            'investimento_total' => Iniciativa::sum('investimento'),
            'por_regiao' => Estado::select('regiao', DB::raw('count(iniciativas.id) as total'))
                ->leftJoin('iniciativas', 'estados.id', '=', 'iniciativas.estado_id')
                ->groupBy('regiao')
                ->get(),
            'por_tipo' => Iniciativa::select('tipo', DB::raw('count(*) as total'))
                ->groupBy('tipo')
                ->get(),
            'por_status' => Iniciativa::select('status', DB::raw('count(*) as total'))
                ->groupBy('status')
                ->get(),
        ]);
    }
}
```

#### 3. **API Resources**

**`EstadoResource.php`**:
```php
class EstadoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sigla' => $this->sigla,
            'nome' => $this->nome,
            'regiao' => $this->regiao,
            'dados_geograficos' => $this->dados_geograficos,
            'iniciativas_count' => $this->iniciativas()->count(),
        ];
    }
}
```

**`IniciativaResource.php`**:
```php
class IniciativaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'tipo' => $this->tipo,
            'status' => $this->status,
            'investimento' => $this->investimento,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'estado' => [
                'sigla' => $this->estado->sigla,
                'nome' => $this->estado->nome,
            ],
        ];
    }
}
```

#### 4. **Form Request Personalizado**

**`IniciativaFilterRequest.php`**:
```php
class IniciativaFilterRequest extends FormRequest
{
    public function authorize()
    {
        return true; // API pública
    }
    
    public function rules()
    {
        return [
            'tipo' => 'sometimes|in:água,ecologia,saneamento,energia,conservação',
            'status' => 'sometimes|in:em_andamento,concluído,planejado',
            'data_inicio' => 'sometimes|date',
            'data_fim' => 'sometimes|date',
            'q' => 'sometimes|string|max:255',
        ];
    }
}
```

#### 5. **Query Scopes no Model**

**`Iniciativa.php`**:
```php
public function scopePorTipo($query, $tipo)
{
    return $query->where('tipo', $tipo);
}

public function scopePorStatus($query, $status)
{
    return $query->where('status', $status);
}
```

#### 6. **Exemplos de Uso da API**

**Listar estados**:
```bash
GET /api/estados
```

**Buscar iniciativas de SP**:
```bash
GET /api/estados/SP/iniciativas
```

**Filtrar por tipo**:
```bash
GET /api/iniciativas?tipo=água&status=em_andamento
```

**Buscar por texto**:
```bash
GET /api/iniciativas?q=cantareira
```

**Estatísticas**:
```bash
GET /api/estatisticas
```

#### 7. **Características da API**

- **RESTful**: Segue padrões REST
- **Resources**: Formatação consistente de dados
- **Filtros Dinâmicos**: Query parameters flexíveis
- **Validação**: Form Requests personalizados
- **Cache**: Otimização com Laravel Cache
- **Scopes**: Queries reutilizáveis
- **Relacionamentos**: Eager loading automático
- **Estatísticas**: Agregações com SQL

---

## 📄 Páginas Estáticas

### Sobre, Galeria e Home

#### 1. **SobreController**
```php
class SobreController extends Controller
{
    public function index() {
        return view('sobre');
    }
}
```

#### 2. **GaleriaController**
```php
class GaleriaController extends Controller
{
    public function index() {
        return view('galeria');
    }
}
```

#### 3. **HomeController**
- Página inicial com seções:
  - Hero section
  - Galeria interativa
  - Mapa do conhecimento
  - Educação ambiental

#### 4. **Características**

- **Conteúdo Estático**: Não dependem de banco de dados
- **Design Responsivo**: Adaptado para todos os dispositivos
- **Navegação Intuitiva**: Menu principal conecta todas as páginas
- **Call-to-Actions**: Botões direcionam para funcionalidades principais

---

## 🔐 Sistema de Autenticação

### Laravel Breeze

#### 1. **Funcionalidades Incluídas**

- **Registro de Usuários**: Criação de contas
- **Login/Logout**: Autenticação segura
- **Recuperação de Senha**: Reset via email
- **Verificação de Email**: Confirmação de conta
- **Perfil do Usuário**: Edição de dados

#### 2. **Middleware de Proteção**

```php
// Rotas protegidas
Route::middleware(['auth'])->group(function () {
    Route::get('/curso', [CursoController::class, 'index']);
    Route::get('/quizz', [QuizzController::class, 'index']);
});
```

#### 3. **Controllers de Autenticação**

- **RegisteredUserController**: Registro
- **AuthenticatedSessionController**: Login
- **PasswordResetLinkController**: Recuperação
- **ProfileController**: Perfil do usuário

---

## 👑 Sistema de Administração

### Como Promover Usuários para Administrador

#### 1. **Estrutura do Sistema Admin**

**Campo no Banco de Dados**:
```sql
-- Tabela users tem o campo is_admin
users:
- id, name, email, password
- is_admin (boolean, padrão: false)
```

**Middleware de Proteção**:
```php
// AdminMiddleware.php
if (auth()->check() && auth()->user()->is_admin) {
    return $next($request); // Permite acesso
}
return redirect('/')->with('error', 'Acesso negado.');
```

#### 2. **Rotas Administrativas**

```php
// Rotas protegidas por ['auth', 'admin']
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/cursos', [CursoController::class, 'adminIndex']);
    Route::resource('quizz', AdminQuizzController::class);
});
```

#### 3. **Como Promover um Usuário**

##### **Método 1: Via Tinker (Recomendado)**
```bash
php artisan tinker
```
```php
$user = App\Models\User::where('email', 'usuario@email.com')->first();
$user->is_admin = true;
$user->save();
```

##### **Método 2: Via Banco de Dados**
```sql
UPDATE users SET is_admin = 1 WHERE email = 'usuario@email.com';
```

##### **Método 3: Criar Admin via Seeder**
```bash
php artisan make:seeder AdminUserSeeder
```

**`AdminUserSeeder.php`**:
```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

public function run()
{
    User::updateOrCreate(
        ['email' => 'admin@fontenova.com'],
        [
            'name' => 'Administrador',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]
    );
}
```

Executar o seeder:
```bash
php artisan db:seed --class=AdminUserSeeder
```

#### 4. **Credenciais Admin Padrão**

Após executar o `AdminUserSeeder`:
- **Email**: admin@fontenova.com
- **Senha**: admin123
- **Acesso**: `/admin/cursos` e `/admin/quizz`

#### 5. **Verificar Usuários Admin**

```bash
php artisan tinker
```
```php
// Listar todos os admins
App\Models\User::where('is_admin', true)->get();

// Contar admins
App\Models\User::where('is_admin', true)->count();
```

#### 6. **Remover Privilégios Admin**

```bash
php artisan tinker
```
```php
$user = App\Models\User::where('email', 'usuario@email.com')->first();
$user->is_admin = false;
$user->save();
```

---

## 🔧 Comandos Úteis para Desenvolvimento

### Seeders
```bash
# Limpar e inserir dados reais
php artisan db:seed --class=LimparIniciativasSeeder
php artisan db:seed --class=IniciativaRealSeeder

# Adicionar tópicos do chatbot
php artisan db:seed --class=TopicoSeeder

# Adicionar aulas do curso
php artisan db:seed --class=AulaSeeder
```

### Migrations
```bash
# Executar novas migrations
php artisan migrate

# Reset completo (cuidado!)
php artisan migrate:fresh --seed
```

### Criação de Conteúdo
```bash
# Criar nova aula
php artisan tinker
>>> App\Models\Aula::create([
    'titulo' => 'Nova Aula',
    'descricao_html' => '<p>Conteúdo...</p>',
    'ordem' => 1
]);

# Criar novo tópico para chatbot
>>> App\Models\Topico::create([
    'nome' => 'Novo Tópico',
    'palavras_chave' => 'palavra1,palavra2',
    'resumo' => 'Resposta do bot...'
]);
```

### Debug
```bash
# Verificar dados
php artisan tinker
>>> App\Models\Aula::count()
>>> App\Models\Topico::all()
>>> App\Models\User::count()
```n migrate:fresh --seed
```

### Debug
```bash
# Verificar dados
php artisan tinker
>>> App\Models\Iniciativa::count()
>>> App\Models\Topico::all()
```

---

## 📝 Notas Importantes

### Arquitetura Geral
1. **MVC Pattern**: Model-View-Controller bem estruturado
2. **Eloquent ORM**: Relacionamentos e queries otimizadas
3. **Blade Templates**: Sistema de templates do Laravel
4. **Middleware**: Proteção de rotas sensíveis
5. **Seeders/Factories**: Dados de teste e produção

### Funcionalidades por Tipo
1. **Dinâmicas (Banco de Dados)**:
   - Mapa Interativo (Estados + Iniciativas)
   - ChatBot (Tópicos + Palavras-chave)
   - Sistema de Cursos (Aulas ordenadas)
   - Autenticação (Usuários)

2. **Estáticas (Hardcoded)**:
   - Página Sobre a Água (Array no controller)
   - Quiz (JavaScript frontend)
   - Galeria e Sobre (Views simples)

3. **Híbridas**:
   - Home (Estática + Mapa dinâmico)

### Segurança
1. **Validação**: Todos os inputs são validados
2. **Escape**: Dados escapados antes da exibição
3. **CSRF**: Proteção contra ataques CSRF
4. **Autenticação**: Laravel Breeze integrado
5. **Middleware**: Controle de acesso por rota

### Performance
1. **Queries Otimizadas**: Relacionamentos Eloquent
2. **Cache**: Possibilidade de cache em controllers
3. **Assets**: CSS/JS organizados e minificados
4. **Lazy Loading**: Carregamento sob demanda

### Manutenibilidade
1. **Código Documentado**: Comentários em português
2. **Estrutura Padrão**: Segue convenções Laravel
3. **Separação de Responsabilidades**: Cada controller tem função específica
4. **Seeders Organizados**: Dados de teste e produção separados
5. **Migrations Versionadas**: Controle de versão do banco