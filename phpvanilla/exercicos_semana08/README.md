## parte A:
1. **O que é PDO?**
   PDO é uma forma do PHP se conectar ao banco de dados. Ele é bom porque facilita o uso de diferentes bancos e tem recursos de segurança.

2. **O que é DSN?**
   DSN é a string usada para informar os dados da conexão com o banco. `host` é o endereço, `port` é a porta e `dbname` é o nome do banco.

3. **Qual é a porta padrão do PostgreSQL?**
   A porta padrão é a **5432**. Ela é colocada na conexão como `port=5432`.

4. **O que faz o ERRMODE_EXCEPTION?**
   Faz o PHP mostrar uma exceção quando acontece um erro na conexão ou na consulta. Assim, podemos tratar o erro com `try/catch`.

5. **Qual a vantagem do FETCH_ASSOC?**
   Ele retorna os dados usando o nome das colunas, evitando dados duplicados e ajudando no uso de memória.

6. **Por que não criar uma conexão a cada consulta?**
   Porque muitas conexões ao mesmo tempo podem atingir o limite de conexões do PostgreSQL.

7. **Por que o construtor é private?**
   Para impedir que outras partes do programa criem novas conexões. O `__clone` e o `__wakeup` também são bloqueados para manter uma única instância.

8. **Por que não deixar usuário e senha no código?**
   Porque outras pessoas podem ter acesso ao código e descobrir essas informações. Por isso, é melhor deixar em um arquivo de configuração.

9. **Por que não mostrar `$e->getMessage()` na tela?**
   Porque ele pode mostrar informações internas do sistema e do banco. Isso pode causar problemas de segurança. O correto é registrar o erro no log e mostrar uma mensagem simples.
