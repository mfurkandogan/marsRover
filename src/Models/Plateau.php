<?php

namespace marsRover\Models;


class Plateau
{
    private $xMaxLocation;
    private $yMaxLocation;

    /**
     * @return int
     */
    public function getXMaxLocation()
    {
        return $this->xMaxLocation;
    }

    /**
     * @param int|string $xMaxLocation
     */
    public function setXMaxLocation($xMaxLocation)
    {
        if (!is_int($xMaxLocation)) {
            throw new \Exception('try to set a invalid x range');
        }
        $this->xMaxLocation = $xMaxLocation;
    }

    /**
     * @return int
     */
    public function getYMaxLocation()
    {
        return $this->yMaxLocation;
    }

    /**
     * @param int|string $yMaxLocation
     */
    public function setYMaxLocation($yMaxLocation)
    {
        if (!is_int($yMaxLocation)) {
            throw new \Exception('try to set a invalid y range');
        }
        $this->yMaxLocation = $yMaxLocation;
    }

    /**
     * Surface constructor.
     * @param int $xMaxLocation
     * @param int $yMaxLocation
     * @throws \Exception
     */
    public function __construct($xMaxLocation, $yMaxLocation)
    {
        $this->setXMaxLocation($xMaxLocation);
        $this->setYMaxLocation($yMaxLocation);
    }


    public function getPointByPosition($locationX, $locationY)
    {
        if ($locationX === $this->getXMaxLocation()) {
            $locationX = 0;
        }

        if ($locationY === $this->getYMaxLocation()) {
            $locationY = 0;
        }

        return new Point($locationX, $locationY);
    }
}