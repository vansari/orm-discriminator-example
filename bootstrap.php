<?php
declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

require_once 'vendor/autoload.php';

function getPostgresEntityManager(): EntityManager
{
    return getEntityManager(
        [
            'driver' => 'pdo_pgsql',
            'port' => '5432',
        ]
    );
}

function getMariaDbEntityManager(): EntityManager
{
    return getEntityManager(
        [
            'driver' => 'pdo_mysql',
            'port' => '3306',
        ]
    );
}

function getEntityManager(array $params): EntityManager
{
    $config = getConfiguration();
    $defaultParams = getDefaultParams();
    $params = array_merge(
        $params,
        $defaultParams
    );
    $connection = DriverManager::getConnection(
        $params,
        $config
    );

    return new EntityManager($connection, $config);
}

/**
 * @return string[]
 */
function getDefaultParams(): array
{
    return [
        'host' => '127.0.0.1',
        'user' => 'dummy',
        'password' => 'it-is-not-safe',
        'dbname' => 'public',
    ];
}

/**
 * @return Configuration
 */
function getConfiguration(): Configuration
{
    return ORMSetup::createAttributeMetadataConfiguration(
        paths: [
            __DIR__ . '/src/',
            __DIR__ . '/src/Entity/',
        ],
        isDevMode: true
    );
}