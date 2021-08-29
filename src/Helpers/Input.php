<?php


namespace Marsrover\Helpers;


class Input
{
    public static function movementCommands($commands)
    {
        return array_filter(
            array_map(
                function (string $command) {
                    return mb_strtoupper($command);
                },
                str_split(trim($commands))
            )
        );
    }
}