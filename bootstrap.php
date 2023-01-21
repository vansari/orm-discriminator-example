<?php
declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once 'vendor/autoload.php';

function getEntityManager(): EntityManager
{
    $config = ORMSetup::createAttributeMetadataConfiguration(
        paths: [__DIR__ . '/src/Entity'],
        isDevMode: true
    );

    $defaultParams = [
        'host' => 'localhost',
        'user' => 'dummy',
        'password' => 'it-is-not-safe',
        'dbname' => 'public',
    ];

    $mySqlParams = array_merge(
        [
            'driver' => 'pdo_mysql',
            'port' => '3306',
        ],
        $defaultParams
    );

    $postgresParams = array_merge(
        [
            'driver' => 'pdo_pgsql',
            'port' => '5432',
        ],
        $defaultParams
    );

    $connection = DriverManager::getConnection(
        $mySqlParams,
        $config
    );

    return new EntityManager($connection, $config);
}