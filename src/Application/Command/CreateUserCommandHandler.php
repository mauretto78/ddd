<?php

namespace Mauretto78\DDD\Application\Command;

use Mauretto78\DDD\Domain\Model\User;
use Mauretto78\DDD\Domain\Model\UserId;
use SimpleEventStoreManager\Application\Event\EventManager;
use SimpleEventStoreManager\Domain\Model\Contracts\EventInterface;

class CreateUserCommandHandler
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
    public function handle(CreateUserCommand $command)
    {
        $user = User::create(
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
