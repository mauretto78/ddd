<?php

namespace Mauretto78\DDD\Domain\Model;

use Assert\Assertion;

class IataCode
{
    /**
     * @var
     */
    private $code;

    /**
     * AirlineCode constructor.
     * @param $code
     */
    public function __construct($code)
    {
        $this->setCode($code);
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    private function setCode($code)
    {
        $code = trim($code);

        Assertion::length($code, 2);

        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function __toString()
    {
        return $this->getCode();
    }
}
