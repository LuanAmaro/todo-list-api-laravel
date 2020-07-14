# Laravel API - TO-DO List

## Instalação

1. Clone o repositório: `git clone https://github.com/LuanAmaro/todo-list-api-laravel.git <NOME_DO_SEU_PROJETO>`
2. Acesse o diretório: `cd <NOME_DO_SEU_PROJETO>`
3. Instale as dependências do projeto: `composer install`
4. Crie um novo arquivo com as configurações de ambiente a partir do arquivo de exemplo: `cp .env.example .env`
5. Após a instalação, gere uma chave para o projeto: `php artisan key:generate`
6. Configure o seu arquivo `.env` para poder rodar as `migrate`, feito as configuração rode: `php artisan migrate`

## Autenticação

Para realizar a autenticação, será necessário, primeiramente, gerar um client token do tipo `password`, para isto, basta executar o seguinte comando:

```
$ php artisan passport:client --password
```

> Note que será necessário prover um nome ao `client`.

Ao final da execução, será gerado um `client_id` e um `client_secret`, que por sua vez, deverão ser utilizados no arquivo [.env.js](https://github.com/LuanAmaro/todo-list-reactjs/blob/master/src/.env.example.js) do seu aplicativo.
