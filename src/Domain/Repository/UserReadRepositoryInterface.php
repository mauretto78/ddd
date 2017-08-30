<?php

namespace Mauretto78\DDD\Domain\Repository;

use Mauretto78\DDD\Domain\Model\UserId;

interface UserReadRepositoryInterface
{
    public function find(UserId $userId);
}
