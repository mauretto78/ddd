<?php

namespace Mauretto78\DDD\Domain\Repository;

interface UserRepositoryInterface
{
    public function findByUsername($username);

    public function findByEmail($email);
}
