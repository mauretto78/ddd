<?php

namespace Mauretto78\DDD\Infrastructure\WriteModel;

use SimpleEventStoreManager\Application\Event\EventManager;

class UserRepository
{
    private $em;

    public function __construct(EventManager $em)
    {
        $this->em = $em;
    }

    public function save()
    {
    }
}