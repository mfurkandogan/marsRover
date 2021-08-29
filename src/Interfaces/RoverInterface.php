<?php

namespace Marsrover\Interfaces;

use Marsrover\Models\Spin;
use Marsrover\Models\Move;

interface RoverInterface extends PositionableInterface
{
    public function spin(Spin $spin);
    public function move(Move $move);
}
