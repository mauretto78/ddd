<?php

namespace Mauretto78\DDD\Test\Domain\Model;

use Mauretto78\DDD\Domain\Model\User;
use Mauretto78\DDD\Domain\Model\UserId;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_thrwos_InvalidArgumentException_if_blank_email_is_provided()
    {
        $user = new User(new UserId(), 'Mauro', ' ', 'mauretto78', '@Mauretto78');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_thrwos_InvalidArgumentException_if_blank_username_is_provided()
    {
        $user = new User(new UserId(), 'Mauro', 'assistenza@easy-grafica.com', ' ', 'mauretto78');
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function it_thrwos_InvalidArgumentException_if_blank_password_is_provided()
    {
        $user = new User(new UserId(), 'Mauro', 'assistenza@easy-grafica.com', 'mauretto78', ' ');
    }

    /**
     * @test
     */
    public function it_should_return_expected_properties_values()
    {
        $user = new User(new UserId('demo'), 'Mauro', 'assistenza@easy-grafica.com', 'mauretto78', 'mauretto78');

        $this->assertEquals($user->getUserId(), 'demo');
        $this->assertEquals($user->getName(), 'Mauro');
        $this->assertEquals($user->getEmail(), 'assistenza@easy-grafica.com');
        $this->assertEquals($user->getUsername(), 'mauretto78');
        $this->assertEquals($user->getPassword(), 'mauretto78');
    }
}