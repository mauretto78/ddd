<?php

namespace Mauretto78\DDD\Domain\Model;

use Assert\Assertion;
use SimpleEventStoreManager\Domain\EventRecorder\EventRecorderCapabilities;

class User
{
    use EventRecorderCapabilities;

    /**
     * @var UserId
     */
    private $userId;

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
     * User constructor.
     * @param UserId $userId
     * @param $name
     * @param $last_name
     * @param $email
     */
    private function __construct(
        UserId $userId,
        $name,
        $last_name,
        $email
    )
    {
        $this->userId = $userId;
        $this->setName($name);
        $this->setLastName($last_name);
        $this->setEmail($email);
    }

    /**
     * @param UserId $userId
     * @param $name
     * @param $last_name
     * @param $email
     * @return User
     */
    public static function create(
        UserId $userId,
        $name,
        $last_name,
        $email
    )
    {
        self::record(
            new UserWasCreated(
                [
                    'aggregate' => 'user-'. (string)$userId,
                    'id' => $userId,
                    'name' => $name,
                    'last_name' => $last_name,
                    'email' => $email
                ]
            )
        );

        return new self(
            $userId,
            $name,
            $last_name,
            $email
        );
    }

    /**
     * @return UserId
     */
    public function userId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    private function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function lastName()
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    private function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    private function setEmail($email)
    {
        $email = trim($email);

        if(!$email){
            throw new \InvalidArgumentException('email not provided');
        }

        Assertion::email($email);

        $this->email = $email;
    }
}
