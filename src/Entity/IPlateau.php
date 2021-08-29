<?php


namespace Marsrover\Entity;


use Marsrover\Interfaces\IPlateau;
use Marsrover\Interfaces\IPositionable;
use Marsrover\Models\Position;

class IPlateau implements IPlateau
{
    private $position;

    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    public function relativePosition(IPositionable $object)
    {
        return $object;
    }
}