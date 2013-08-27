<?php

class Player
{
    private $current;
    public function __construct()
    {
        $this->current = 'o';
    }

    public function current()
    {
        return $this->current;
    }

    public function change()
    {
        $this->current = ($this->current === 'o') ? 'x' : 'o';
    }
}
