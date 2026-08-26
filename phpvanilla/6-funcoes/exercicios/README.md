## Lista de Exercícios
## Parte A

## 1. Conceito de Função:
Uma função é uma parte do programa que serve para fazer uma tarefa específica. Ela ajuda a organizar o código e evita que eu precise escrever a mesma coisa várias vezes.

**Duas vantagens são:**
Evitar repetição de código.
Deixar o programa mais organizado e fácil de entender.

---

## 2. Pricípio DRY:
DRY significa "Don't Repeat Yourself", ou seja, "não se repita".

Repetir o mesmo código em vários lugares pode dar problema porque, se eu precisar mudar alguma coisa, vou ter que mudar em todos os lugares. Com uma função, posso escrever o código uma vez e usar a função várias vezes.

---

## 3. Prâmetros e retorno:
```php
function calculadoraTotal(float $preco, int $quantidade): float {
    return $preco * $quantidade
}
```
Os parâmetros são os valores que entram na função. Nesse exemplo, são $preco e $quantidade.

O return devolve o resultado da função.

Por exemplo, se o preço for 10 e a quantidade for 3, o resultado será 30.

---

## 4. Tipagem:
**Na função:**
```php
function cadastrar(string $nome, int $idade): bool
```

$nome é string, ou seja texto.
$idade é int, ou seja, número inteiro.
bool significa que a função retorna true ou false.

---

## 5. void e return:
Uma função que retorna string devolve um texto:
```php
function mensagem(): string {
    return "Olá!";
}

uma função void não retorna um valor:
function mostrarMensagem(): void {
    echo "Olá!";
}
```

---

## 6. Escopo:
A função não consegue acessar $cliente  porque a variável foi criada fora dela.

**Uma forma de corrigir é passar a variável como parâmetro:**
```php
$cliente = "Mariana";

function exibirCliente(string $cliente): string {
    return $cliente;
}

echo exibirCliente($cliente);
```

Outra forma seria usar global, mas acho melhor passar como parâmetro porque fica mais organizado.

---

## 7. Referência:
Quando usamos & no parâmetro, a função pode alterar a variável original.

Por exemplo:
```php
function aumentar(float &$valor): void {
    $valor += 10;
}
```
Nesse caso, se $valor for 100, depois da função ele será 110.

Sem o &, a função trabalharia com uma cópia e a variável original não seria alterada.

---

## 8. Cinco funções nativas:
*strlen()* -> conta o tanho de um texto.
*trim()* -> remove espaços do começo e do final do texto.
*strtolower()* -> transforma o texto em letras minúsculas.
*ucfirst()* -> deixa a primeira letra maiúscula.
*count()* -> conta quantos elementos existem em um array.

---

## 9. Previsão de saída:
```php
function aplicarDesconto(float $preco): float {
    return $preco * 0.90;
}

$valor = 100.00;

echo aplicarDesconto($valor);
echo $valor;
```
A função calcula 90% de 100, então retorna 90.

A variável $valor continua sendo 100 porque a função não altera a variável original.

Como os dois echo estão juntos, o resultado será:
90100

---

## 10. Documentação:
A função strlen() serve para descobrir o tamanho de uma string.

Sua sintaxe é:
```php
strlen(string $string): int
```
Ela recebe uma string e retorna um int.

---

