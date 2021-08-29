<?php


namespace Marsrover\Models;


class Position
{
    public $xCoordinate;
    public $yCoordinate;

    public function __construct(Coordinate $xCoordinate, Coordinate $yCoordinate)
    {
        $this->xCoordinate = $xCoordinate;
        $this->yCoordinate = $yCoordinate;
    }

    public function change(Coordinate $xCoordinate, Coordinate $yCoordinate)
    {
        return new self($xCoordinate, $yCoordinate);
    }

    public function valueX()
    {
        return $this->xCoordinate;
    }

    public function valueY()
    {
        return $this->yCoordinate;
    }

}