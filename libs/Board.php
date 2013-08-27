<?php
class Board
{
    private $board;
    private $player;
    private $input_history = array();

    public function __construct($player, $command)
    {
        $this->board = [
            [null, null, null],
            [null, null, null],
            [null, null, null],
            ];
        $this->player = $player;
        $this->command = $command;
    }

    public function draw()
    {
        $output = '';
        $cell_index = 1;
        foreach ($this->board as $line) {
            $output .= '---------------------' . PHP_EOL;
            $output .= ' | ';
            foreach ($line as $v) {
                $output .= ($v === null) ? " {$cell_index} " : " {$v} ";
                $output .= ' | ';
                $cell_index++;
            }
            $output .= PHP_EOL;
        }
        $output .= '---------------------' . PHP_EOL;
        return $output;
    }

    public function cellIndexToArrayKey($cell_index)
    {
        switch (true) {
        case ($cell_index <= 3):
            $x = 0;
            $y = $cell_index - 1;
            break;
        case ($cell_index <= 6):
            $x = 1;
            $y = $cell_index - 4;
            break;
        case ($cell_index <= 9):
            $x = 2;
            $y = $cell_index - 7;
            break;
        default:
            return false;
            break;
        }

        return array($x, $y);
    }

    public function isValidChoise($input)
    {
        if ($input < 1 || $input > 9) return false;

        list($x, $y) = $this->cellIndexToArrayKey($input);

        return $this->board[$x][$y] === null;
    }

    public function put($cell_index, $player)
    {
        list($x, $y) = $this->cellIndexToArrayKey($cell_index);
        $this->board[$x][$y] = $player;
    }

    public function call($method, $args)
    {
        $this->command->$method($this, $args);
    }

    public function playerChange()
    {
        $this->player->change();
    }

    public function currentPlayer()
    {
        return $this->player->current();
    }

    public function isFilled()
    {
        foreach ($this->board as $line) {
            foreach ($line as $cell) {
                if ($cell === null) return false;
            }
        }
        return true;
    }

    public function isAligned()
    {
        // horizontal direction
        foreach ($this->board as $line) {
            $player = $line[0];
            if ($player === null) continue;
            if ($line[1] === $player && $line[2] === $player) return true;
        }

        // vertical direction
        foreach ($this->board[0] as $k => $v) {
            $player = $v;
            if ($player === null) continue;
            if ($this->board[1][$k] === $player && $this->board[2][$k] === $player) return true;
        }

        // diagonal direction
        $player = $this->board[0][0];
        if ($player !== null && $this->board[1][1] === $player && $this->board[2][2] === $player) return true;

        $player = $this->board[0][2];
        if ($player !== null && $this->board[1][1] === $player && $this->board[2][0] === $player) return true;

        return false;
    }
}


