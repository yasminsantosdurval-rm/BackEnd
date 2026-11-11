# Exercícios de Fixação e Prática: Sessões, Cookies e Autenticação

## Sobre a atividade

Esta atividade foi desenvolvida utilizando PHP e PostgreSQL, com o objetivo de praticar conceitos de segurança, cadastro de usuários, autenticação, controle de acesso e registro de tentativas de login.

Foram desenvolvidos cinco exercícios práticos.

## Tecnologias utilizadas

- PHP
- PostgreSQL
- PDO para conexão com o banco de dados
- Visual Studio Code
- Terminal do Windows (PowerShell)

## Organização dos arquivos

- `ex01_cli_cadastro.php`: cadastro de colaboradores pelo terminal.
- `ex02_inspetor_hash.php`: consulta informações de um hash de senha.
- `ex03_rbac_guard.php`: controle de acesso de acordo com o perfil do usuário.
- `ex04_bloqueio_tentativas.php`: bloqueio após três tentativas de login incorretas.
- `ex05_log_acessos.php`: registro das tentativas de acesso no banco de dados.
- `UsuarioDAO.php`: classe responsável por realizar o cadastro dos usuários no banco.

## Desenvolvimento dos exercícios

### Exercício 01: Cadastro de colaboradores

Foi desenvolvido um cadastro pelo terminal, solicitando nome, e-mail e senha do colaborador.

Foram utilizadas validações para verificar se o nome e o e-mail são válidos e se a senha possui pelo menos oito caracteres, incluindo letra maiúscula, letra minúscula, número e caractere especial.

Para proteger a senha, foi utilizada a função `password_hash()` com o algoritmo Argon2id. Os dados foram armazenados no PostgreSQL utilizando PDO e a classe `UsuarioDAO`.

### Exercício 02: Inspetor de Hash

Foi criado um programa que recebe um hash pelo terminal e apresenta algumas informações sobre ele.

Foram utilizadas as funções `password_get_info()` e `explode()` para consultar o algoritmo, a versão, os custos, o salt e o hash.

O objetivo foi entender como uma senha é armazenada de forma protegida.

### Exercício 03: Controle de acesso (RBAC)

Foi criada a função `verificarPermissao()` para verificar se o perfil do usuário possui autorização para acessar determinada área.

No teste, foi utilizado um usuário com perfil OPERADOR tentando acessar uma área ADMIN.

O sistema retornou o erro HTTP 403, informando que o acesso não foi permitido.

### Exercício 04: Bloqueio de tentativas

Foi desenvolvido um sistema que conta as tentativas de login incorretas.

Após três tentativas erradas, o acesso fica bloqueado por 60 segundos.

Foi utilizada a sessão do PHP para armazenar a quantidade de tentativas e o tempo de bloqueio. Também foi utilizada a função `password_verify()` para verificar a senha.

### Exercício 05: Registro de acessos

Foi criada a tabela `auditoria_logins` no PostgreSQL para armazenar os registros de acesso.

O programa solicita o e-mail e informa se o login foi bem-sucedido ou não.

Os registros armazenam:
- E-mail do usuário.
- Endereço IP.
- Identificação do acesso.
- Resultado do login.
- Data e horário do registro.

Também foi realizada uma consulta SQL para visualizar os registros salvos na tabela.

## Como executar os exercícios

1. Abra a pasta `exercicios_semana10` no Visual Studio Code.
2. Verifique se o PHP está instalado e funcionando.
3. Confira se o PostgreSQL está ativo e se o arquivo de configuração do banco está correto.
4. Abra o terminal na pasta dos exercícios.
5. Execute cada arquivo utilizando o comando:

```bash
php nome_do_arquivo.php
```

Exemplo:

```bash
php ex01_cli_cadastro.php
```

## Banco de dados

Foi utilizado o banco de dados `almoxarifado_senai`.

A tabela `usuarios` armazena os dados dos colaboradores cadastrados.

A tabela `auditoria_logins` armazena os registros das tentativas de acesso.

A conexão com o banco foi realizada utilizando PDO e um arquivo de configuração `database.ini`.

## Conclusão

Com esta atividade, consegui praticar conceitos importantes de segurança em PHP, como proteção de senhas com hash, validação de dados, sessões, controle de permissões e registro de acessos.

Também pratiquei a conexão entre PHP e PostgreSQL, utilizando consultas SQL e PDO para armazenar e consultar informações.

A atividade ajudou a entender melhor como funcionam alguns recursos de segurança utilizados em sistemas com autenticação de usuários.