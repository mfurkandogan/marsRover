<?php

namespace marsRover\Models;


class Point
{

    private $locationX;

    private $locationY;

    /**
     * @return int
     */
    public function getLocationX()
    {
        return $this->locationX;
    }

    /**
     * @param int $locationX
     */
    public function setLocationX($locationX)
    {
        if (!is_int($locationX)) {
            throw new \Exception('invalid x range');
        }
        $this->locationX = $locationX;
    }

    /**
     * @return int
     */
    public function getLocationY()
    {
        return $this->locationY;
    }

    /**
     * @param int $locationY
     */
    public function setLocationY($locationY)
    {
        if (!is_int($locationY)) {
            throw new \Exception('üinvalid y range');
        }
        $this->locationY = $locationY;
    }

    /**
     * Point constructor.
     * @param int $locationX
     * @param int $locationY
     * @throws \Exception
     */
    public function __construct($locationX, $locationY)
    {
        $this->setLocationX($locationX);
        $this->setLocationY($locationY);
    }
}