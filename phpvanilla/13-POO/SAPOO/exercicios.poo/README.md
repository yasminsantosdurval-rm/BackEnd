# Parte A: Questões Teóricas de Fixação

**1. Procedural vs. OO:**  
Os três principais riscos são repetir códigos, dificultar a manutenção e cometer erros nas regras financeiras, como permitir um saque maior que o saldo disponível.

**2. Ciclo de Vida do Objeto:**  
Quando usamos `new ContaCorrente(...)`, um objeto é criado na memória do servidor. O método `__construct()` é executado para inicializar esse objeto com os dados da conta, como agência, número e saldo inicial.

**3. A Pseudo-Variável `$this`:**  
O `$this->saldo` acessa o saldo que pertence ao objeto atual. Já `$saldo` é uma variável local, que só existe dentro de determinada função ou método e não representa necessariamente o atributo da conta.

**4. Encapsulamento e Invariantes:**  
Porque qualquer parte do código poderia alterar o saldo diretamente, até colocar um valor inválido. O ideal é mudar o saldo por métodos como depositar e sacar, que verificam as regras da conta.

**5. Modificadores de Acesso:**  
O `private` permite acessar o atributo somente dentro da própria classe. O `protected` permite acessar também dentro das classes filhas que usam `extends`.

**6. Constructor Property Promotion:**  
Esse recurso do PHP 8 permite declarar e inicializar atributos diretamente nos parâmetros do construtor. Assim, precisamos escrever menos código e fica mais fácil entender quais dados o objeto recebe.

**7. Propriedades `readonly`:**  
A palavra-chave `readonly` impede que uma propriedade seja alterada livremente depois de inicializada. Isso ajuda a manter dados como os de um titular consistentes durante o uso do objeto.

**8. Classes Abstratas:**  
A classe `ContaBancaria` pode ser abstrata porque serve como modelo para outras contas, sem precisar criar uma conta genérica diretamente. `ContaCorrente` e `ContaPoupanca` são concretas porque podem ser instanciadas e possuem suas próprias regras.

**9. Polimorfismo:**  
O método recebe uma conta do tipo `ContaBancaria`, então pode trabalhar com qualquer classe filha desse tipo. Assim, ele consegue transferir dinheiro sem precisar verificar se o destino é uma conta corrente ou poupança.

**10. Exceções de Domínio:**  
Retornar `false` ou `null` pode dificultar a identificação do motivo pelo qual o saque falhou. Uma exceção específica, como `SaldoInsuficienteException`, deixa claro o problema e permite tratar o erro corretamente.