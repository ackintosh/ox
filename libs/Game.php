<?php

class Game
{
    public static function run($turn)
    {
        $board = new Board(new Player(), new Command());
        while (true) {
            $turn($board);
            if (self::isFinished($board)) {
                echo $board->draw();
                die('Finished.' . PHP_EOL);
            }
        }
    }

    public static function isFinished($board)
    {
        return $board->isFilled() || $board->isAligned();
    }
}

