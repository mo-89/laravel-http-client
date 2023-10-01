【共通】

composer global require laravel/installer

./vendor/bin/sail artisan make:migration create_customers_table

Schema::create('customers', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->integer('age');
    $table->text('memo')->nullable();
    $table->timestamps();
});
./vendor/bin/sail artisan migrate


=========================================================
(1)HTTPクライアント

composer create-project --prefer-dist laravel/laravel http_client
php artisan sail:install
   [mysql]を選択
docker-compose.yml 変更
    laravel.test:
        ports:
            #- '${APP_PORT:-80}:80'
            - '8081:80'
    mysql:
        image: 'mysql/mysql-server:8.0'
        ports:
            #- '${FORWARD_DB_PORT:-3306}:3306'
            - '${FORWARD_DB_PORT:-33061}:3306'
            #- '${VITE_PORT:-5173}:${VITE_PORT:-5173}'
            - '${VITE_PORT:-5174}:${VITE_PORT:-5173}'


./vendor/bin/sail up

ymlを変更すると、反映のために
docker compose downをしないといけない？


./vendor/bin/sail artisan make:controller CustomerController

./vendor/bin/sail artisan make:model Customer


docker exec -it http_client-mysql-1 bash

mysql -u sail -ppassword

use laravel;


=========================================================
(2)POST先サーバー

composer create-project --prefer-dist laravel/laravel post_server
php artisan sail:install
   [mysql]を選択
docker-compose.yml 変更
    laravel.test:
        ports:
            #- '${APP_PORT:-80}:80'
            - '8082:80'

    mysql:
        image: 'mysql/mysql-server:8.0'
        ports:
            #- '${FORWARD_DB_PORT:-3306}:3306'
            - '${FORWARD_DB_PORT:-33062}:3306'
            #- '${VITE_PORT:-5173}:${VITE_PORT:-5173}'
            - '${VITE_PORT:-5175}:${VITE_PORT:-5173}'

./vendor/bin/sail up -d



./vendor/bin/sail artisan make:controller CustomerApiController

./vendor/bin/sail artisan make:model Customer


docker exec -it post_server-mysql-1 bash

mysql -u sail -ppassword

use laravel;

