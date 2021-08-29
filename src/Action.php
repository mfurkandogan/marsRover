<?php


namespace Marsrover;


use Marsrover\Interfaces\RoverInterface;
use Marsrover\Models\Move;
use Marsrover\Models\Spin;

class Action
{
    private $rover;

    public function __construct(RoverInterface $rover)
    {
        $this->rover = $rover;
    }

    public function act(array $movement)
    {
        foreach ($movement as $operation) {
            try {
                $this->rover->spin(new Spin($operation));
            } catch (\Exception $e) {
                try {
                    $this->rover->move(new Move($operation));
                } catch (\Exception $e) {
                    $e->getMessage();
                }
            }
        }

        return $this->rover;
    }
}