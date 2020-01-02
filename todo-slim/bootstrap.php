<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// bootstrap.php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Types\Type;
use Acelaya\Doctrine\Type\PhpEnumType;
use Todo\Domain\Model\Todo\TodoStatus;
use Todo\Infrastructure\Persistence\Doctrine\Type\TodoIdType;

require_once "vendor/autoload.php";

// Create a simple "default" Doctrine ORM configuration for XML
$isDevMode = true;
$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/src/Todo/Infrastructure/Persistence/Doctrine/Mapping"), $isDevMode);
// or if you prefer yaml or annotations
//$useSimpleAnnotationReader = false;
//$proxyDir = null;
//$cache = null;
//$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode, $proxyDir, $cache, $useSimpleAnnotationReader);
//$config = Setup::createYAMLMetadataConfiguration(array(__DIR__."/config/yaml"), $isDevMode);

// database configuration parameters
$conn = array(
    'driver'   => 'pdo_mysql',
    'host'     => '127.0.0.1',
    'dbname'   => 'ws_todo',
    'user'     => 'root',
    'password' => 'root'
);

PhpEnumType::registerEnumTypes([
    'todo_status' => TodoStatus::class
]);

Type::addType('todo_id', TodoIdType::class);

// obtaining the entity manager
$entityManager = EntityManager::create($conn, $config);