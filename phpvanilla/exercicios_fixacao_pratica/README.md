## PARTE A: Exercícios Teóricos de Fixação

### 1. Definição de CRUD

CRUD significa **Create, Read, Update e Delete**. Cada letra representa uma operação:

* **C – Create:** criar dados → `INSERT`
* **R – Read:** consultar dados → `SELECT`
* **U – Update:** atualizar dados → `UPDATE`
* **D – Delete:** apagar dados → `DELETE`

### 2. Anatomia do SQL Injection

O SQL Injection acontece quando o sistema coloca diretamente um dado do usuário dentro do comando SQL usando concatenação de texto. Assim, o atacante pode digitar algo que muda a consulta original e faz o banco interpretar aquela entrada como parte do comando SQL.

### 3. Mecanismo das Prepared Statements

As Prepared Statements funcionam em duas etapas: primeiro o sistema prepara o comando SQL e depois envia os valores. Assim, o que o usuário digita é tratado como **dado**, e não como parte do comando SQL. Isso ajuda a evitar SQL Injection.

### 4. Marcadores Nomeados

Os marcadores nomeados, como `:sku` e `:preco`, deixam o código mais fácil de entender. Em consultas maiores, fica mais simples saber qual valor pertence a cada parte do comando.

### 5. Diferença entre Bindings

O `bindValue()` passa o valor naquele momento.

O `bindParam()` liga uma variável ao parâmetro e usa o valor da variável quando o comando for executado. Por isso, o `bindParam()` trabalha diretamente com uma variável.

### 6. Tipagem no PDO

Quando não informamos o tipo correto, um valor que deveria ser número pode ser tratado de outra forma. Em comandos como `LIMIT`, isso pode causar erro ou comportamento diferente do esperado. Por isso, é melhor usar `PDO::PARAM_INT` quando o valor for inteiro.

### 7. Padrão DAO

O DAO serve para separar a parte que acessa o banco de dados do restante do sistema. Isso facilita a manutenção, porque cada parte fica responsável por uma função específica. Isso também segue o princípio da **responsabilidade única** do SOLID.

### 8. Operações de Update

Se um `UPDATE` for feito sem `WHERE`, o comando pode alterar **todos os registros da tabela**. Em um sistema real isso pode causar uma grande perda ou alteração de dados que não deveriam ser modificados.

### 9. Impacto da LGPD

Se acontecer um vazamento de dados por uma falha de segurança, a empresa pode sofrer consequências previstas na LGPD. Dependendo do caso, a ANPD pode aplicar **advertência, multa simples ou diária, publicização da infração, bloqueio ou eliminação de dados**, além de outras sanções previstas na lei. A multa simples pode chegar a **2% do faturamento**, limitada a **R$ 50 milhões por infração**.

Além disso, quando o incidente puder causar risco ou dano relevante, o controlador deve comunicar a ANPD e os titulares afetados.
