<?php

namespace Mauretto78\DDD\Infrastructure\Persistance\ReadModel;

use Doctrine\DBAL\Connection;
use Mauretto78\DDD\Domain\Model\UserId;
use Mauretto78\DDD\Domain\Repository\UserReadRepositoryInterface;

class UserReadRepository implements UserReadRepositoryInterface
{
    /**
     * @var Connection
     */
    private $db;

    /**
     * UserReadRepository constructor.
     * @param $db
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * @param UserId $userId
     * @return mixed
     */
    public function find(UserId $userId)
    {
        $statement = $this->db->executeQuery('SELECT * FROM  `users` WHERE id = ?', [(string) $userId]);

        return $statement->fetch();
    }
}

