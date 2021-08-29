<?php

namespace Marsrover\Interfaces;

use Marsrover\Models\Spin;
use Marsrover\Models\Move;

interface IRover extends IPositionable
{
    public function spin(Spin $spin);
    public function move(Move $move);
}
