## Sobre este projeto
- Este projeto foi desenvolvido para o teste técnico da empresa PayNet, via Workana. O objetivo desse teste é criar uma página de cadastro, login, recuperação de senha e home. Além de autenticar via API com Sanctum, consultar uma API de cep e enviar notificações via e-mail para usuários.

## Guia de instalação e teste do projeto
- Para instalar o projeto, você precisará ter o básico para um projeto Laravel em seu computador.
- Clone o projeto em sua máquina local.
- Instale as dependências do projeto com o comando `npm install`, `npm run build` e em seguida `composer install`.
- Configure o arquivo `.env` com as informações de banco de dados, se preferir pode usar o `.env.exemple`.
- Também é necessário incluir os dados de acesso ao seu servidor de email no arquivo `.env`.
- Execute o comando `php artisan key:generate` para gerar a chave de aplicação.
- Execute o comando `php artisan migrate --seed` para criar as tabelas no banco de dados com exemplos de usuários já criados.
- Execute o comando `php artisan serve` para iniciar o servidor do Laravel.
- Acesse a página do projeto em `http://localhost:3000`.
- Para testar a página de cadastro, login, recuperação de senha e home, acesse as seguintes rotas:
- Cadastro: `http://localhost:3000/cadastro`
- Login: `http://localhost:3000/login`
- Recuperação de senha: `http://localhost:3000/forgot-password`
- Home: `http://localhost:3000/home`
- Para testar a autenticação, você precisará criar um usuário e senha. Você pode fazer isso acessando a rota `/cadastro` e preenchendo o formulário de cadastro.
- Após criar um usuário, você pode fazer login acessando a rota `/login` e preenchendo o formulário de login com o usuário e senha criados anteriormente. Além disso, você receberá um e-mail de boas-vindas.
- Para testar a recuperação de senha, você precisará acessar a rota `/forgot-password` ou clicar no botão `Esqueceu sua senha?` na tela de login e preencher o formulário de recuperação de senha com o e-mail do usuário criado anteriormente.
- Após preencher o formulário de recuperação de senha, você receberá um e-mail com um link para resetar a senha.
- Você pode resetar a senha acessando o link recebido no e-mail e preenchendo o formulário de redefinição de senha.
- Após resetar a senha, você receberá um e-mail notificando que sua senha foi redefinida e você pode fazer login novamente acessando a rota `/login` com o usuário e senha atualizados.
- Para testar a página de home, você só precisará informar um login e senha válidos na rota `/login`.
- Após fazer login, você será redirecionado para a página home.
- Na página de home, você pode ver uma lista com os dados de todos os usuários cadastrados.
