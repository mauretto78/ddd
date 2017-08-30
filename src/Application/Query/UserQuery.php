<?php

namespace Mauretto78\DDD\Application\Query;

use Mauretto78\DDD\Domain\Model\UserId;

class UserQuery
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * CreateUserCommand constructor.
     * @param UserId $id
     */
    public function __construct(
        UserId $id
    )
    {
        $this->id = $id;
    }

    /**
     * @return UserId
     */
    public function id()
    {
        return $this->id;
    }
}
