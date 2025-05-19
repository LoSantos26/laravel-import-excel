<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Sobre o Projeto - Import-Excel

Esta é uma API aplicando alguns conceitos Restful, utilizando o framework Laravel, tendo o propósito de ser um exemplo de como criar uma API com Laravel de upload de arquivos Excel (.csv). Esta é uma primeira versão, onde futuramente serão adicionadas novas funcionalidades, como autenticação, testes, entre outros.


## Como instalar
Para o funcionamente desta API, é necessário um ambiente com Docker, para utilizar o Dockerfile do projeto.
Após baixar o projeto execute os comandos em sequência:

```bash
docker-compose build
docker-compose up -d
docker-compose exec app bash
composer install
php artisan migrate
```

Para possíveis problemas com cache de configuração do projeto, execute o comando:

```bash
php artisan optimize
php artisan config:clear
php artisan config:cache
```

Após a execução dos comandos, configure seu arquivo `.env` com as informações do banco de dados, como o nome do banco, usuário e senha. O arquivo `.env.example` já está configurado com as informações padrão do Docker.

## Rotas disponíveis

O projeto está rodando na porta 8080 e o banco de dados na porta 3307.

Os endpoints disponíeveis são:
- `POST /arquivo/upload` - Realizar upload de arquivo CSV;
- `GET /arquivo/buscar` - Buscar um arquivo utilizando filtro de "name" e "date";
- `GET /arquivo/buscar-conteudo` - Buscar um conteúdo do arquivo utilizando os filtros de "name" e "email";
- `GET /arquivo/buscar-todos` - Buscar todos os arquivos, podendo passar "offser", "limit" e "sent_at" como filtros;

Além de ser uma API aplicando conceitos Restful, este projeto também foi implementado utilizando conceitos de Domain Driven Design (DDD) e Clean Architecture.


