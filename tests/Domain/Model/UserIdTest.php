<?php

namespace Mauretto78\DDD\Test\Domain\Model;

use Mauretto78\DDD\Domain\Model\UserId;
use PHPUnit\Framework\TestCase;

class UserIdTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_return_expected_id_value_if_a_valid_value_is_provided()
    {
        $userId = new UserId('demo');

        $this->assertEquals('demo', $userId);
        $this->assertEquals('demo', $userId->getId());
    }

    /**
     * @test
     */
    public function it_should_return_expected_id_value()
    {
        $userId = new UserId('demo');
        $userId2 = new UserId('demo');

        $this->assertTrue($userId->equals($userId2));
    }
}