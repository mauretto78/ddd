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
        $this->_setName($name);
        $this->_setEmail($email);
        $this->_setUsername($username);
        $this->_setPassword($password);
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    private function _setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    private function _setEmail($email)
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    private function _setUsername($username)
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    private function _setPassword($password)
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
