<?php

namespace Mauretto78\DDD\Infrastructure\Persistance\ReadModel;

use Mauretto78\DDD\Domain\Model\UserId;
use Mauretto78\DDD\Domain\Repository\UserReadRepositoryInterface;

class UserReadRepository implements UserReadRepositoryInterface
{
    public function find(UserId $userId)
    {
        return 23;
    }
}

