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

#### 1. **Estrutura Frontend**

**`quizz.blade.php`** contém 3 telas:
```html
<!-- Tela inicial -->
<div id="start-screen" class="screen active">
    <h1>FonteNova - Salve a Água</h1>
    <p>Quiz educativo sobre economia de água...</p>
    <button id="start-btn">Começar</button>
</div>

<!-- Tela do quiz -->
<div id="quiz-screen" class="screen">
    <h2 id="question">Pergunta</h2>
    <div class="answers">
        <button class="answer" id="a"></button>
        <button class="answer" id="b"></button>
        <button class="answer" id="c"></button>
    </div>
</div>

<!-- Tela de resultado -->
<div id="result-screen" class="screen">
    <h2>Resultado</h2>
    <p id="score"></p>
    <button id="restart-btn">Refazer Quiz</button>
</div>
```

#### 2. **JavaScript do Quiz**

**`quizz.js`** (estrutura típica):
```javascript
const questions = [
    {
        question: "Quanto tempo você demora no banho?",
        answers: {
            a: "Menos de 5 minutos",
            b: "Entre 5-10 minutos", 
            c: "Mais de 10 minutos"
        },
        correct: "a",
        savings: [50, 25, 0] // Litros economizados
    }
];

function showQuestion() {
    // Exibe pergunta atual
    // Configura botões de resposta
}

function selectAnswer(answer) {
    // Calcula pontuação
    // Avança para próxima pergunta
}

function showResult() {
    // Exibe total de água economizada
    // Mostra dicas de sustentabilidade
}
```

#### 3. **Fluxo do Quiz**

```
Tela Inicial → 7 Perguntas → Cálculo de Economia → Resultado Final
```

#### 4. **Sistema de Pontuação**

- **Perguntas sobre Hábitos**: Banho, torneira, descarga, etc.
- **Cálculo de Economia**: Cada resposta tem valor em litros
- **Resultado Educativo**: Mostra impacto das escolhas
- **Gamificação**: Incentiva melhores práticas

#### 5. **Características**

- **Educativo**: Ensina sobre economia de água
- **Interativo**: Interface dinâmica com JavaScript
- **Responsivo**: Funciona em mobile e desktop
- **Motivacional**: Mostra impacto positivo das ações

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