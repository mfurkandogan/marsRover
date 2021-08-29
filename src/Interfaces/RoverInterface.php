<?php

namespace Marsrover\Interfaces;

use Marsrover\Models\Spin;
use Marsrover\Models\Move;

interface RoverInterface extends PositionableInterface
{

    /**
     * @param Spin $spin
     * @return void
     */
    public function spin(Spin $spin);

    /**
     * @param Move $move
     * @return void
     */
    public function move(Move $move);
}
