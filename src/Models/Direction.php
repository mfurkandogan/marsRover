<?php


namespace Marsrover\Models;


class Direction
{
    public $direction = '';

    const X_AXIS = 'X';
    const Y_AXIS = 'Y';

    const  NORTH = 'N';
    const  SOUTH = 'S';
    const  EAST  = 'E';
    const  WEST  = 'W';

    const  AVAILABLE_DIRECTIONS = [self::NORTH, self::SOUTH, self::EAST, self::WEST];

    const  LEFT_TO_RIGHT_DIRECTIONS = [
        self::NORTH => self::WEST,
        self::WEST  => self::SOUTH,
        self::SOUTH => self::EAST,
        self::EAST  => self::NORTH,
    ];

    const  RIGHT_TO_LEFT_DIRECTIONS = [
        self::NORTH => self::EAST,
        self::EAST  => self::SOUTH,
        self::SOUTH => self::WEST,
        self::WEST  => self::NORTH,
    ];

    const  AXIS_MAP = [
        self::NORTH => self::Y_AXIS,
        self::SOUTH => self::Y_AXIS,
        self::EAST  => self::X_AXIS,
        self::WEST  => self::X_AXIS,

    ];

    const  AXIS_VALUE_MAP = [
        self::NORTH =>  1,
        self::WEST  =>  1,
        self::EAST  => -1,
        self::SOUTH => -1,
    ];

    public function __construct($direction)
    {
        $direction = strtoupper(trim($direction));
        if (in_array($direction, self::AVAILABLE_DIRECTIONS)) {
            $this->direction = $direction;
        } else {
            return false;
        }
    }

    public function change($spin)
    {
        if (Spin::LEFT === $spin) {
            return new self(self::RIGHT_TO_LEFT_DIRECTIONS[$this->direction]);
        }

        return new self(self::LEFT_TO_RIGHT_DIRECTIONS[$this->direction]);
    }

    public function axis()
    {
        return self::AXIS_MAP[$this->direction];
    }

    public function axisValue()
    {
        return self::AXIS_VALUE_MAP[$this->direction];
    }
}