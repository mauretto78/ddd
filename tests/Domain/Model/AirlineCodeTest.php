<?php

namespace Mauretto78\DDD\Test\Domain\Model;

use Mauretto78\DDD\Domain\Model\AirlineCode;
use Mauretto78\DDD\Domain\Model\UserId;
use PHPUnit\Framework\TestCase;

class AirlineTest extends TestCase
{
    /**
     * @test
     * @expectedException \Assert\AssertionFailedException
     */
    public function it_throws_AssertionFailedException_if_invalid_value_is_provided()
    {
        $airlineCode = new AirlineCode('AZA');
    }

    /**
     * @test
     */
    public function it_should_return_expected_id_value_if_a_valid_value_is_provided()
    {
        $airlineCode = new AirlineCode('AZ');

        $this->assertEquals('AZ', $airlineCode);
        $this->assertEquals('AZ', $airlineCode->getCode());
    }
}
