<?php


namespace Marsrover\Models;


class Coordinate
{
    private $coordinate = 0;

    public function __construct($coordinate)
    {
        $this->coordinate = $coordinate;
    }

    public function increaseCoordinateBy($coordinate)
    {
        return new self($this->coordinate + $coordinate);
    }
}