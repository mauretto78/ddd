<?php

namespace Mauretto78\DDD\Domain\Model;

use Ramsey\Uuid\Uuid;

class UserId
{
    /**
     * @var int
     */
    private $id;

    public function __construct($id = null)
    {
        $this->id = (isset($id)) ? $id : Uuid::uuid4()->toString();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param UserId $userId
     * @return bool
     */
    public function equals(UserId $userId)
    {
        return $this->getId() === $userId->getId();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getId();
    }
}
