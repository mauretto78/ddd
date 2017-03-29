<?php

namespace auretto78\DDD\Domain\Service;

interface UserLogin
{
    public function attempt($username, $password);
}