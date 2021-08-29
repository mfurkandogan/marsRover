<?php


namespace Marsrover\Models;


class Move
{
    const COMMAND_MOVE = 'M';

    const MOVEMENT_FACTOR = 1;

    const ALLOWED_COMMANDS = [
        self::COMMAND_MOVE,
    ];

    public function __construct($command)
    {
        if (!in_array($command, self::ALLOWED_COMMANDS)) {
            throw new \Exception($command." is not a defined command");
        }
    }

    public function factor($value)
    {
        return (self::MOVEMENT_FACTOR * $value);
    }
}