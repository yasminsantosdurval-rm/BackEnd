## LISTA DE EXERCÍCIOS: PROCESSAMENTO HTTP E FORMULÁRIOS

### Parte A: Exercícios Teóricos de Fixação

1. **Diferença Estrutural:** Explique a diferença física entre onde os dados são anexados em uma requisição `GET` e em uma requisição `POST`.

*Resposta*: No `GET`, os dados do formulário são anexados à URL, depois do ?, no formato de parâmetros de consulta. Exemplo: **pagina.php?nome=Joao&idade=20.**
No `POST`, os dados são enviados no body da requisição HTTP, não ficando expostos na URL.

2. **Segurança e Privacidade:** Por que senhas de usuário nunca devem ser enviadas via método `GET`? Cite pelo menos dois locais onde essa senha ficaria gravada de forma insegura.
R. Porque essas senhas ficam visíveis na URL. Elas podem ficar gravadas de forma insegura no histórico do navegador e em logs do servidor, por exemplo.

3. **Coalescência Nula:** Por que a instrução `$nome = $_POST['nome'];` dispara um `Warning` na primeira vez que a página é carregada no navegador? Como o operador `??` resolve isso?
R. A instrução $nome = $_POST['nome']; dispara um Warning (Undefined array key "nome") porque, no primeiro carregamento da página, o formulário ainda não foi enviado, fazendo com que a chave "nome" não exista dentro da superglobal $_POST.

4. **Idempotência:** O que significa dizer que uma requisição `GET` é idempotente? Por que atualizar ou deletar dados no banco usando links `GET` é uma má prática de segurança?
R. Significa que repetir a mesma requisição GET não muda nada no banco. Por isso não pode usar GET pra deletar ou editar: só de clicar no link, já apagaria.

5. **Validação Client vs Server:** Um desenvolvedor júnior afirma que o formulário dele é 100% seguro porque colocou `required` e `type="email"` em todas as tags HTML. Explique por que essa afirmação é falsa.
R.Essa afirmação é falsa porque `required` e `type="email"` fazem a validação **no navegador**. O usuário pode desativar ou alterar essas validações. Por isso, o servidor também precisa **verificar os dados recebidos** antes de aceitá-los.


6. **XSS e Sanitização:** Qual é o risco de exibir dados vindos de um `$_POST` diretamente na tela sem utilizar `htmlspecialchars()`?
R. Exibir diretamente um dado recebido pelo $_POST pode causar um problema de segurança chamado XSS. Isso acontece quando uma pessoa envia um conteúdo malicioso em um formulário e esse conteúdo é exibido na página como código. Para evitar esse problema, usamos htmlspecialchars(), que transforma caracteres especiais e faz com que o conteúdo seja tratado como texto.  

7. **Sticky Forms:** O que é a técnica de *Sticky Forms* e qual é o seu impacto na experiência do usuário (UX)?
R. A técnica do `Sticky Form` consiste em imprimir de volta no atributo `value` do input os dados que o usuário acaba de digitar caso ocorra um erro de validação de dados. Isso melhora a experiência do usuário, porque ele não precisa preencher tudo de novo.

8. **DevTools:** Como você utilizaria a aba *Network* do navegador para comprovar que um formulário foi enviado via `POST` e não via `GET`?
R. Para comprovar que um formulário foi enviado via POST e não via GET, você deve abrir a aba Network (Rede) das ferramentas de desenvolvedor do navegador (F12) antes de enviar o formulário e analisar a linha de requisição gerada.
