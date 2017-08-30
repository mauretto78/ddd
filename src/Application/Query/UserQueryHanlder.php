<?php

namespace Mauretto78\DDD\Application\Query;

use Broadway\CommandHandling\SimpleCommandHandler;
use Mauretto78\DDD\Domain\Repository\UserReadRepositoryInterface;

class UserQueryHanlder extends SimpleCommandHandler
{
    /**
     * @var UserReadRepositoryInterface
     */
    private $repo;

    public function __construct(UserReadRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param UserQuery $userQuery
     */
    public function handleUserQuery(UserQuery $userQuery)
    {
        return $this->repo->find($userQuery->id());
    }
}
