

## Развернуть проект
1. Поменять версию  mariaDB
1.1поменять в папке docker -docker-compose.yml  версию на 10.8.2
...MySQL Service
mysql:
build:
context: ./mariadb
args:
- http_proxy
- https_proxy
- no_proxy
- MARIADB_VERSION=10.8.2 ...

1.2 ...в папке docker->mariadb->-Dockerfile
ARG MARIADB_VERSION=10.8.2
FROM mariadb:10.8.2 ...

1.3  sudo chmod -R 777 -(дать права на папку docker)

1.4 Проверяем 
- docker ps
- PMA на localhost 



2. из папки docker: docker-compose -p pa up -d 

3. Заходим в контейнер app: docker exec -it gpb_pa_1 bash
3.1 composer install

3.2 настраиваем .env 

3.3 в контейнере
php artisan key:generate
php artisan storage:link
chown -R www-data:www-data /var/www
php artisan migrate --seed
php artisan clear-compiled
php artisan cache:clear
php artisan route:clear
php artisan view:clear
php artisan config:clear




## Установить vite в контейнере

 apt update
 apt install nodejs npm
 npm install
 
-Run the Vite development server...
npm run dev
 
-Build and version the assets for production...
npm run build
 

