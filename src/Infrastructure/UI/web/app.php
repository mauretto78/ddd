<?php

use Mauretto78\DDD\Application\Command\CreateUserCommand;
use Mauretto78\DDD\Application\Command\CreateUserCommandHandler;
use Mauretto78\DDD\Domain\Model\UserId;
use Mhytry\Silex\SimpleBus\CommandBus\CommandBusServiceProvider;
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

// Command-bus map
$app->register(new CommandBusServiceProvider(), [
    'simplebus.commandbus.command_to_handler_map' => [
        CreateUserCommand::class => new CreateUserCommandHandler($app['event_manager'])
    ]
]);

// Event-bus map

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

    $createUser = new CreateUserCommand(
        new UserId,
        $request->request->get('name'),
        $request->request->get('last_name'),
        $request->request->get('email')
    );

    $app['simplebus.commandbus']->handle($createUser);

    return $app->json([

    ]);
});

$app->put('/user/{id}', function (Request $request, $id) use ($app) {

});

$app->get('/user/{id}', function (Request $request, $id) use ($app) {
    return $app->json([
        'message' => $id
    ]);
});

// Run Silex
$app->run();