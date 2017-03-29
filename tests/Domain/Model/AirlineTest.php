<?php

namespace Mauretto78\DDD\Test\Domain\Model;

use Mauretto78\DDD\Domain\Model\Airline;
use Mauretto78\DDD\Domain\Model\IataCode;
use PHPUnit\Framework\TestCase;

class AirlineTest extends TestCase
{
    /**
     * @test
     * @expectedException \Assert\AssertionFailedException
     */
    public function it_throws_InvalidArgumentException_if_invalid_iata_code_is_provided()
    {
        $airline = new Airline(
            new IataCode('AZAA'),
            'Alitalia',
            'Italian flag airline',
            'www.alitalia.it',
            '800800800'
        );
    }

    /**
     * @test
     */
    public function it_should_return_expected_values_if_valid_values_are_provided()
    {
        $airline = new Airline(
            new IataCode('AZ'),
            'Alitalia',
            'Italian flag airline',
            'www.alitalia.it',
            '800800800'
        );

        $this->assertInstanceOf(IataCode::class, $airline->getIataCode());
        $this->assertEquals('Alitalia', $airline->getName());
        $this->assertEquals('Italian flag airline', $airline->getDescription());
        $this->assertEquals('www.alitalia.it', $airline->getWebsite());
        $this->assertEquals('800800800', $airline->getPhone());
    }
}
