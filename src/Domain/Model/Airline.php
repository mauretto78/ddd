<?php

namespace Mauretto78\DDD\Domain\Model;

use Assert\Assertion;

class Airline
{
    /**
     * @var IataCode
     */
    private $iataCode;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $phone;

    /**
     * Airline constructor.
     * @param IataCode $iataCode
     * @param $name
     * @param $description
     * @param $website
     * @param $phone
     */
    public function __construct(
        IataCode $iataCode,
        $name,
        $description,
        $website,
        $phone
    )
    {
        $this->_setIataCode($iataCode);
        $this->_setName($name);
        $this->_setDescription($description);
        $this->_setWebsite($website);
        $this->_setPhone($phone);
    }

    /**
     * @param IataCode $iataCode
     */
    private function _setIataCode(IataCode $iataCode)
    {
        Assertion::isInstanceOf($iataCode, IataCode::class);

        $this->iataCode = $iataCode;
    }

    /**
     * @param mixed $name
     */
    private function _setName($name)
    {
        Assertion::maxLength($name, 255);

        $this->name = $name;
    }

    /**
     * @param mixed $description
     */
    private function _setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $website
     */
    private function _setWebsite($website)
    {
        Assertion::maxLength($website, 255);

        $this->website = $website;
    }

    /**
     * @param mixed $phone
     */
    private function _setPhone($phone)
    {
        Assertion::digit($phone, 'phone number is invalid');

        $this->phone = $phone;
    }

    /**
     * @return IataCode
     */
    public function getIataCode(): IataCode
    {
        return $this->iataCode;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getWebsite(): string
    {
        return $this->website;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }
}
