<?php


namespace Marsrover\Models;

class Surface
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
            throw new \Exception('invalid x range');
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
     * @throws \Exception
     */
    public function setYMaxLocation($yMaxLocation)
    {
        if (!is_int($yMaxLocation)) {
            throw new \Exception('invalid y range');
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

        try {
            return new Point($locationX, $locationY);
        } catch (\Exception $e) {
            throw new \Exception('invalid Point');
        }
    }
}