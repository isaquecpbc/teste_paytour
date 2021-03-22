# teste Netshowme PHP em Laravel

1. Depois do clone ou download, na pasta raiz, abrir o terminal e executar $ composer update para o composer fazer download dos arquivos.
> $ composer update

2. criar um banco de dados e o configurar no arquivo .env.example na raiz:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=netshowme
DB_USERNAME=root
DB_PASSWORD=

salve o arquivo sem o ".example", apenas como ".env"

3. Para regenerar corretamente as classes e seus componentes: $ composer dump-autoload

4. Para executar criar as tabelas no banco de dados usamos o migration: $ php artisan migrate

5. iniciar o laravel com $ php artisan serve

O aplicativo executar em http://127.0.0.1:8000

## Instruções do sistema

1. A primeira página entra no fomrmulário de cadastro

2. Para acessar os cadastros, alteralos e excluílos, basta escrever 
> /contacts

3. Os arquivos enviados ficam em "public/archives/contacts"

4. O email não pode enviar com apache localhost, para isso, o php precisa de um servidor, e no momento estou sem, mas se o projeto estivesse online, descomentariamos as linhas que enviam localizadas em "\app\Http\Controllers\ContactsController.php" linhas 99-110.