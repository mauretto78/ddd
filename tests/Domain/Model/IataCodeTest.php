<?php

namespace Mauretto78\DDD\Test\Domain\Model;

use Mauretto78\DDD\Domain\Model\IataCode;
use PHPUnit\Framework\TestCase;

class IataCodeTest extends TestCase
{
    /**
     * @test
     * @expectedException \Assert\AssertionFailedException
     */
    public function it_throws_AssertionFailedException_if_invalid_value_is_provided()
    {
        $iataCode = new IataCode('AZA');
    }

    /**
     * @test
     */
    public function it_should_return_expected_id_value_if_a_valid_value_is_provided()
    {
        $iataCode = new IataCode('AZ');

        $this->assertEquals('AZ', $iataCode);
        $this->assertEquals('AZ', $iataCode->getCode());
    }
}
