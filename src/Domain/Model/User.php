<?php

namespace Mauretto78\DDD\Domain\Model;

use Assert\Assertion;

class User
{
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
    private $email;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    public function __construct(
        UserId $userId,
        $name,
        $email,
        $username,
        $password
    )
    {
        $this->userId = $userId;
        $this->setName($name);
        $this->setEmail($email);
        $this->setUsername($username);
        $this->setPassword($password);
    }

    /**
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $email = trim($email);

        if(!$email){
            throw new \InvalidArgumentException('email not provided');
        }

        Assertion::email($email);

        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $username = trim($username);

        if(!$username){
            throw new \InvalidArgumentException('username not provided');
        }

        Assertion::notEmpty($username);
        Assertion::notBlank($username);

        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $password = trim($password);

        if(!$password){
            throw new \InvalidArgumentException('password not provided');
        }

        Assertion::notEmpty($password);
        Assertion::notBlank($password);
        Assertion::betweenLength($password, 4, 10);

        $this->password = $password;
    }
}
