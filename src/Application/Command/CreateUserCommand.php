<?php

namespace Mauretto78\DDD\Application\Command;

use Mauretto78\DDD\Domain\Model\UserId;

class CreateUserCommand
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var string
     */
    private $email;

    /**
     * CreateUserCommand constructor.
     * @param UserId $id
     * @param $name
     * @param $last_name
     * @param $email
     */
    public function __construct(
        UserId $id,
        $name,
        $last_name,
        $email
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
    }

    /**
     * @return UserId
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
     * @return string
     */
    public function lastName()
    {
        return $this->last_name;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }
}
