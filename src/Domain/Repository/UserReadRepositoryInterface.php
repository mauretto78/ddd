<?php

namespace Mauretto78\DDD\Domain\Repository;

interface UserReadRepositoryInterface
{
    public function findByUsername($username);

    public function findByEmail($email);
}
