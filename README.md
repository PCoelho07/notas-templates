# Módulo Templates

## Como desenvolver ?

1) Clone o repositório

2) Instale as dependências

3) Crie o arquivo `database/database.sqlite`

4) Salve uma cópia do arquivo `.env.example` como `.env` e defina `sqlite` como driver de conexão

5) Execute as migrações e seeders   

6) Execute os testes

```console
git clone https://<your-username>@bitbucket.org/rfdeoliveira/notas-templates.git templates
cd templates
composer install
touch database/database.sqlite
cp .env.example .env
# Configure no .env DB_CONNECTION=sqlite
php artisan migrate --seed
vendor/bin/phpunit
```


## Como fazer o deployment ?

1) Clone o repositório

2) Configure no servidor web o sub-diretório do projeto `/public` como document root

3) Salve uma cópia do arquivo `.env.example` como `.env` e defina o driver de conexão, nome e credenciais do banco de dados

4) Execute as migrações e seeders


```console
git clone https://<your-username>@bitbucket.org/rfdeoliveira/notas-templates.git templates
cd templates
# Configure o servidor Web
cd templates
composer install --no-interaction --no-dev
cp .env.example .env
# Configure as credenciais do banco no .env
php artisan migrate --seed
vendor/bin/phpunit
```  

