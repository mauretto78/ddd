<?php

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use Mauretto78\DDD\Application\Command\CreateUserCommand;
use Mauretto78\DDD\Application\Command\CreateUserCommandHandler;
use Mauretto78\DDD\Application\Query\AllUsersQuery;
use Mauretto78\DDD\Application\Query\AllUsersQueryHandler;
use Mauretto78\DDD\Application\Query\UserQuery;
use Mauretto78\DDD\Application\Query\UserQueryHandler;
use Mauretto78\DDD\Domain\Model\UserId;
use Mauretto78\DDD\Domain\Model\UserWasCreated;
use Mauretto78\DDD\Infrastructure\Persistance\Projection\UserProjector;
use Mauretto78\DDD\Infrastructure\Persistance\ReadModel\UserReadRepository;
use SimpleEventStoreManager\Application\Event\EventManager;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../../../../vendor/autoload.php';

// instantiate Application
$app = new Silex\Application();
$app['env'] = 'dev';

// DBAL connection
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_sqlite',
        'path'     => __DIR__.'/../../../../db/app.db',
    ),
));

// Service container
$app['event_manager'] = function ($app) {
    return EventManager::build()
        ->setDriver('mongo')
        ->setConnection([
            'host' => 'localhost',
            'port' => 27017,
        ]);
};

$app['user_read_repo'] = function ($app) {
    return new UserReadRepository($app['db']);
};

// Command-bus
$app['command_bus'] = function ($app) {
    $locator = new InMemoryLocator();

    // Commands
    $locator->addHandler(new CreateUserCommandHandler($app['event_manager']), CreateUserCommand::class);

    // Event projections
    $locator->addHandler(new UserProjector($app['db']), UserWasCreated::class);

    $handlerMiddleware = new CommandHandlerMiddleware (
        new ClassNameExtractor(),
        $locator,
        new HandleInflector()
    );

    return new CommandBus([$handlerMiddleware]);
};

// Query-bus
$app['query_bus'] = function ($app) {
    $locator = new InMemoryLocator();

    // Queries
    $locator->addHandler(new AllUsersQueryHandler($app['user_read_repo']), AllUsersQuery::class);
    $locator->addHandler(new UserQueryHandler($app['user_read_repo']), UserQuery::class);

    $handlerMiddleware = new CommandHandlerMiddleware (
        new ClassNameExtractor(),
        $locator,
        new HandleInflector()
    );

    return new CommandBus([$handlerMiddleware]);
};

// Controllers
$app->get('/', function (Request $request) use ($app) {
    return $app->json([
        'message' => 'It Works!'
    ]);
});

$app->get('/user', function (Request $request) use ($app) {
    $usersQuery = new AllUsersQuery();
    $users = $app['query_bus']->handle($usersQuery);

    return $app->json([
        'data' => $users
    ]);
});

$app->post('/user', function (Request $request) use ($app) {
    $createNewUser = new CreateUserCommand(
        new UserId,
        $request->request->get('name'),
        $request->request->get('last_name'),
        $request->request->get('email')
    );

    try {
        $userWasCreated = $app['command_bus']->handle($createNewUser);
        $app['command_bus']->handle(array_shift($userWasCreated));

        return $app->json([
            'id' => (string) $createNewUser->id()
        ], \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    } catch (\Exception $e){
        return $app->json([
            'error' => $e->getMessage()
        ], \Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR);
    }
});

$app->get('/user/{id}', function (Request $request, $id) use ($app) {
    $userQuery = new UserQuery(new UserId($id));
    $user = $app['query_bus']->handle($userQuery);

    return $app->json([
        'data' => $user
    ]);
});

// Run Silex
$app->run();
