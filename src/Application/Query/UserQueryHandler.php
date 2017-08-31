<?php

namespace Mauretto78\DDD\Application\Query;

use Mauretto78\DDD\Domain\Repository\UserReadRepositoryInterface;

class UserQueryHandler
{
    /**
     * @var UserReadRepositoryInterface
     */
    private $repo;

    /**
     * UserQueryHandler constructor.
     * @param UserReadRepositoryInterface $repo
     */
    public function __construct(UserReadRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param UserQuery $userQuery
     * @return int
     */
    public function handle(UserQuery $userQuery)
    {
        return $this->repo->find($userQuery->id());
    }
}
