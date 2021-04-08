<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        /* custom conection */
        // Mysql
        'sisin' => [
            'driver' => 'mysql',
            'host' => env('SISIN_HOST', '127.0.0.1'),
            'port' => env('SISIN_PORT', '3306'),
            'database' => env('SISIN_DATABASE', 'sisin'),
            'username' => env('SISIN_USERNAME', 'sisin'),
            'password' => env('SISIN_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'sisindesa' => [
            'driver' => 'mysql',
            'host' => env('SISINDESA_HOST', '127.0.0.1'),
            'port' => env('SISINDESA_PORT', '3306'),
            'database' => env('SISINDESA_DATABASE', 'sisin'),
            'username' => env('SISINDESA_USERNAME', 'sisin'),
            'password' => env('SISINDESA_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'sispro' => [
            'driver' => 'mysql',
            'host' => env('SISPRO_HOST', '127.0.0.1'),
            'port' => env('SISPRO_PORT', '3306'),
            'database' => env('SISPRO_DATABASE', 'sisin'),
            'username' => env('SISPRO_USERNAME', 'sisin'),
            'password' => env('SISPRO_PASSWORD', ''),
            'unix_socket' => env('SISPRO_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        'reportes' => [
            'driver' => 'mysql',
            'host' => env('REPORTES_HOST', '127.0.0.1'),
            'port' => env('REPORTES_PORT', '3306'),
            'database' => env('REPORTES_DATABASE', 'sisin_reportes'),
            'username' => env('REPORTES_USERNAME', 'sisin_reportes'),
            'password' => env('REPORTES_PASSWORD', ''),
            'unix_socket' => env('REPORTES_SOCKET', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],

        //Postgress
        'sisfin' => [
            'driver' => 'pgsql',
            'host' => env('SISFIN_HOST', '127.0.0.1'),
            'port' => env('SISFIN_PORT', '5432'),
            'database' => env('SISFIN_DATABASE', 'forge'),
            'username' => env('SISFIN_USERNAME', 'forge'),
            'password' => env('SISFIN_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'sisfin',
            'sslmode' => 'prefer',
        ],

        'paginaweb' => [
            'driver' => 'pgsql',
            'host' => env('PAGINAWEB_HOST', '127.0.0.1'),
            'port' => env('PAGINAWEB_PORT', '5432'),
            'database' => env('PAGINAWEB_DATABASE', 'forge'),
            'username' => env('PAGINAWEB_USERNAME', 'forge'),
            'password' => env('PAGINAWEB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
        
        'registro' => [
    	    'driver' => 'pgsql',
            'host' => env('PAGINAWEBMPD_HOST', '127.0.0.1'),
            'port' => env('PAGINAWEBMPD_PORT', '5432'),
            'database' => env('PAGINAWEBMPD_DATABASE', 'forge'),
            'username' => env('PAGINAWEBMPD_USERNAME', 'forge'),
            'password' => env('PAGINAWEBMPD_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
