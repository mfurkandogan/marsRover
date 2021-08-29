<?php


namespace Marsrover\Models;


class Spin
{
    const LEFT  = 'L';
    const RIGHT = 'R';
    const AVAILABLE_SPINS = [self::LEFT, self::RIGHT];
    public $spin = '';

    public function __construct($input)
    {
        if (in_array($input, self::AVAILABLE_SPINS)) {
            $this->spin = $input;
        } else {
            return false;
        }
    }
}