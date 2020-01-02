<?php

declare(strict_types=1);


use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Todo\Application\TodoApplicationServiceInterface;
use Todo\Application\TodoApplicationService;
use Todo\Domain\Model\Todo\TodoList as TodoListInterface;
use Todo\Infrastructure\Persistence\Doctrine\TodoList;
use Todo\Infrastructure\Persistence\PDO\PDOTodoList;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Types\Type;
use Acelaya\Doctrine\Type\PhpEnumType;
use Todo\Domain\Model\Todo\TodoStatus;
use Todo\Infrastructure\Persistence\Doctrine\Type\TodoIdType;
use Todo\Domain\Model\Todo\OwnerService;
use Todo\Infrastructure\Service\TranslatingOwnerService;

return static function (ContainerBuilder $containerBuilder, array $settings) {
    $containerBuilder->addDefinitions([
		'settings' => $settings,
		PDO::class => function(ContainerInterface $container) use ($settings) {
            $db = $settings['db'];
            $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['name'],
                $db['username'], $db['password']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        },
		EntityManager::class => function(ContainerInterface $container) use ($settings) {
			
			$isDevMode = true;
			$config = Setup::createXMLMetadataConfiguration(array(__DIR__."/../src/Todo/Infrastructure/Persistence/Doctrine/Mapping"), $isDevMode);
			$conn = array(
				'driver'   => 'pdo_mysql',
				'host'     => $settings['db']['host'],
				'dbname'   => $settings['db']['name'],
				'user'     => $settings['db']['username'],
				'password' => $settings['db']['password'],
			);
			
			PhpEnumType::registerEnumTypes([
				'todo_status' => TodoStatus::class
			]);
			
			Type::addType('todo_id', TodoIdType::class);
			
			// obtaining the entity manager
			$entityManager = EntityManager::create($conn, $config);
			return $entityManager; 
		},
		TranslatingOwnerService::class => DI\autowire(),
		OwnerService::class => DI\autowire(TranslatingOwnerService::class),
		TodoList::class => DI\autowire(),
        PDOTodoList::class => DI\autowire(),
		TodoListInterface::class => DI\autowire(PDOTodoList::class),
		TodoApplicationService::class => DI\autowire(),
		TodoApplicationServiceInterface::class => DI\autowire(TodoApplicationService::class),
    ]);
};