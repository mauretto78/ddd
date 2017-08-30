<?php

namespace Mauretto78\DDD\Application\Command;

use Broadway\CommandHandling\SimpleCommandHandler;
use Mauretto78\DDD\Domain\Model\User;
use Mauretto78\DDD\Domain\Model\UserId;
use SimpleEventStoreManager\Application\Event\EventManager;
use SimpleEventStoreManager\Domain\Model\Contracts\EventInterface;

class CreateUserCommandHandler extends SimpleCommandHandler
{
    /**
     * @var EventManager
     */
    private $eventManager;

    /**
     * CreateUserCommandHandler constructor.
     * @param EventManager $eventManager
     */
    public function __construct(EventManager $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    /**
     * @param CreateUserCommand $command
     */
    public function handleCreateUserCommand(CreateUserCommand $command)
    {
        $user = new User(
            $command->id(),
            $command->name(),
            $command->lastName(),
            $command->email()
        );

        $this->storeEvents($command->id(), $user->releaseEvents());
    }

    /**
     * @param array EventInterface[] $events
     */
    private function storeEvents(UserId $userId, array $events)
    {
        $this->eventManager->storeEvents(
            'user-'.$userId,
            $events
        );
    }
}
