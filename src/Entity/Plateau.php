<?php


namespace Marsrover\Entity;


use Marsrover\Interfaces\PlateauInterface;
use Marsrover\Interfaces\PositionableInterface;
use Marsrover\Models\Position;

class Plateau implements PlateauInterface
{
    private $position;

    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    public function relativePosition(PositionableInterface $object)
    {
        return $object;
    }
}