## ✅ Comparação: `??` vs `?:` vs `if...else`

| Sintaxe                                              | Nome                             | Quando usar                                                                                | Exemplo                                                                 | Equivalente com `if...else`                                              | Resultado                                                |
| ---------------------------------------------------- | -------------------------------- | ------------------------------------------------------------------------------------------ | ----------------------------------------------------------------------- | ------------------------------------------------------------------------ | -------------------------------------------------------- |
| `$x = $a ?? 'valor padrão';`                         | **Null Coalescing** (`??`)       | Quando quer usar um valor **caso não seja `null`**                                         | `$nome = $user->nome ?? 'Anônimo';`                                     | `if ($user->nome !== null) $nome = $user->nome; else $nome = 'Anônimo';` | Usa `$user->nome` se existir, senão `'Anônimo'`          |
| `$x = $a ?: 'valor padrão';`                         | **Ternário simplificado** (`?:`) | Quando quer usar um valor **caso ele não seja "falsy"** (`null`, `false`, `0`, `''`, etc.) | `$nome = $user->nome ?: 'Anônimo';`                                     | `if ($user->nome) $nome = $user->nome; else $nome = 'Anônimo';`          | Usa `$user->nome` se for "verdadeiro", senão `'Anônimo'` |
| `if ($a) { $x = $a; } else { $x = 'valor padrão'; }` | `if...else` tradicional          | Quando precisa de mais controle ou lógica complexa                                         | `if ($user->nome) { $nome = $user->nome; } else { $nome = 'Anônimo'; }` | —                                                                        | Usa `$user->nome` se for "verdadeiro", senão `'Anônimo'` |

---

## 🔍 Diferença principal entre `??` e `?:`

* `??` só verifica se a **variável existe** e **não é `null`**.
* `?:` verifica se a **variável é "falsy"** (vazia, zero, falsa, null, etc.)

---

### ✅ Exemplo prático:

```php
$user->idade = 0;
```

* `{{ $user->idade ?? 'Sem idade' }}` → mostra `0` ✅ (porque `0` **não é null**)
* `{{ $user->idade ?: 'Sem idade' }}` → mostra `'Sem idade'` ❌ (porque `0` é considerado "falsy")

---

## 📌 Quando usar cada um?

| Caso                                                                           | Use         |
| ------------------------------------------------------------------------------ | ----------- |
| Verificar se a variável existe e não é null                                    | `??`        |
| Verificar se a variável tem um valor "verdadeiro" (não vazio, não falso, etc.) | `?:`        |
| Precisa de condições mais complexas ou várias instruções                       | `if...else` |

---

## ✅ Resumo simplificado:

| Código                         | Leitura humana                                                              |
| ------------------------------ | --------------------------------------------------------------------------- |
| `$x = $a ?? 'padrão';`         | Se `$a` não for `null`, usa `$a`, senão usa `'padrão'`                      |
| `$x = $a ?: 'padrão';`         | Se `$a` for verdadeiro (não vazio, não zero...), usa `$a`, senão `'padrão'` |
| `if ($a) { ... } else { ... }` | Quando precisa de lógica mais detalhada                                     |

---
