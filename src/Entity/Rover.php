<?php


namespace Marsrover\Entity;


use Marsrover\Interfaces\IPositionable;
use Marsrover\Interfaces\IRover;
use Marsrover\Models\Direction;
use Marsrover\Models\Move;
use Marsrover\Models\Position;
use Marsrover\Models\Spin;

/**
 * Class Rover
 * @package Marsrover\Entity
 */
class Rover implements IRover
{
    public $direction;
    public $position;


    /**
     * Rover constructor.
     * @param Position $position
     * @param Direction $direction
     */
    public function __construct(Position $position, Direction $direction)
    {
        $this->position  = $position;
        $this->direction = $direction;
    }

    public function spin(Spin $spin)
    {
        $this->direction = $this->direction->change($spin);
    }

    public function move(Move $move)
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


    public function relativePosition(IPositionable $object)
    {
        // TODO: Implement relativePosition() method.
    }
}