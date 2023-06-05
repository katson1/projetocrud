# CRUD simples

Uma projeto de CRUD simples.

## Pré-requisitos

Certifique-se de ter os seguintes softwares instalados em seu sistema:

- PHP 8.x
- Laravel 9.x
- MySQL 8.x

## Instalação

1. Clone o repositório para a sua máquina local.
   ```shell
   git clone https://github.com/katson1/projetocrud.git

2. Navegue até o diretório do projeto.
   ```shell
   cd diretório-do-projeto
   
3. Instale as dependências usando o Composer.
   ```shell
   composer install

4. Crie uma cópia do arquivo .env.example e renomeie-o para .env.
   ```shell
   cp .env.example .env
   
5. Gere a chave da aplicação.
   ```shell
   php artisan key:generate
    
6. Renomeie o arquivo .env.example para .env e altere-o se for preciso. (geralmente o DB_USERNAME do mysql é: root e DB_PASSWORD vazio)
   ```shell
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=seu_banco_de_dados
    DB_USERNAME=seu_nome_de_usuario
    DB_PASSWORD=sua_senha

7. Execute as migrações do banco de dados.
     ```shell
    php artisan migrate

## Executando a Aplicação

1. Para executar a aplicação, utilize o seguinte comando:
   ```shell
   php artisan serve

Isso iniciará o servidor de desenvolvimento do Laravel e você poderá acessar a aplicação em seu navegador da web através de http://localhost:8000.





