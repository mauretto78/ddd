<?php

namespace Mauretto78\DDD\Domain\Model;

use SimpleEventStoreManager\Domain\Model\Contracts\EventInterface;
use SimpleEventStoreManager\Domain\Model\EventId;

class UserWasCreated implements EventInterface
{
    /**
     * @var EventId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var
     */
    private $body;

    /**
     * @var \DateTimeImmutable
     */
    private $occurred_on;

    /**
     * UserWasCreated constructor.
     * @param $body
     */
    public function __construct(
        $body
    ) {
        $this->id = new EventId();
        $this->name = get_class($this);
        $this->body = $body;
        $this->occurred_on = new \DateTimeImmutable();
    }

    /**
     * @return EventId
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function body()
    {
        return $this->body;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function occurredOn()
    {
        return $this->occurred_on;
    }
}