<?php

use Broadway\CommandHandling\SimpleCommandBus;
use Mauretto78\DDD\Application\Command\CreateUserCommand;
use Mauretto78\DDD\Application\Command\CreateUserCommandHandler;
use Mauretto78\DDD\Application\Query\UserQuery;
use Mauretto78\DDD\Application\Query\UserQueryHanlder;
use Mauretto78\DDD\Domain\Model\UserId;

use SimpleEventStoreManager\Application\Event\EventManager;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../../../../vendor/autoload.php';

// instantiate Application
$app = new Silex\Application();
$app['env'] = 'dev';

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
    return new \Mauretto78\DDD\Infrastructure\Persistance\ReadModel\UserReadRepository();
};

// Command-bus map
$app['command_bus'] = function ($app) {
    $commandBus = new SimpleCommandBus();
    $commandBus->subscribe(new CreateUserCommandHandler($app['event_manager']));

    return $commandBus;
};

// Query-bus map
$app['query_bus'] = function ($app) {
    $queryBus = new SimpleCommandBus();
    $queryBus->subscribe(new UserQueryHanlder($app['user_read_repo']));

    return $queryBus;
};

// Projectors map

// Controllers

$app->get('/', function (Request $request) use ($app) {
    return $app->json([
        'message' => 'It Works!'
    ]);
});

$app->get('/user', function (Request $request) use ($app) {

});

$app->post('/user', function (Request $request) use ($app) {

    $createNewUser = new CreateUserCommand(
        new UserId,
        $request->request->get('name'),
        $request->request->get('last_name'),
        $request->request->get('email')
    );

    try {
        $app['command_bus']->dispatch($createNewUser);

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

    return $app->json([
        'message' => $app['query_bus']->dispatch($userQuery)
    ]);
});

// Run Silex
$app->run();
