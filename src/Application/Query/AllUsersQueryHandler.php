<?php

namespace Mauretto78\DDD\Application\Query;

use Mauretto78\DDD\Domain\Repository\UserReadRepositoryInterface;

class AllUsersQueryHandler
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
     * @param AllUsersQuery $allUsersQuery
     * @return mixed
     */
    public function handle(AllUsersQuery $allUsersQuery)
    {
        return $this->repo->findAll();
    }
}
