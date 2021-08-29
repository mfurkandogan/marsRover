<?php


namespace Marsrover\Entity;


use Marsrover\Models\Direction;
use Marsrover\Models\Move;
use Marsrover\Models\Position;

class Rover
{
    private $direction;
    private $position;

    public function __construct(Position $position, Direction $direction)
    {
        $this->position  = $position;
        $this->direction = $direction;
    }

    public function move(Move $move): void
    {
        $value = $move->factor($this->direction->axisValue());

        if (Direction::X_AXIS === $this->direction->axis()) {

            $this->position = $this->position->change(
                $this->position->valueX()->increaseCoordinateBy($value),
                $this->position->valueY()
            );

            return;
        }

        $this->position = $this->position->change(
            $this->position->valueX(),
            $this->position->valueY()->increaseCoordinateBy($value)
        );
    }



}