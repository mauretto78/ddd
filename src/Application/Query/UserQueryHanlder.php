<?php

namespace Mauretto78\DDD\Application\Query;

use Mauretto78\DDD\Domain\Repository\UserReadRepositoryInterface;

class UserQueryHanlder
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
    public function handle(UserQuery $userQuery)
    {
        return $this->repo->find($userQuery->id());
    }
}
