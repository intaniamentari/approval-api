1. Run composer
```
    composer i
```
2. use .env
```
    cp .env.example .env
```
3. Generate key
```
    php artisan key:generate
```
4. Creat database laravel on your MySQL
```
    create database laravel;
```
5. Run migration and seeding for data status
```
    php artisan migrate --seed
```
6. Run local server laravle
```
    php artisan serve
```
7. Open new tab terminal on vscode and run swagger API 
```
    php artisan l5-swagger:generate
```
8. Access API Swagger, with this link link(`http://localhost:8000/api/documentation`)
