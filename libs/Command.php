<?php

class Command
{
    private $history = array();

    public static function isValid($input)
    {
        if (0 < (int)$input && (int)$input < 10) return true;
        return method_exists(new self(), $input);
    }

    public static function parse($input)
    {
        if ((int)$input !== 0) return array('choose', (int)$input);
        return array($input, null);
    }

    public function choose($board, $cell_index)
    {
        if (!$board->isValidChoise($cell_index)) return;
        $board->put($cell_index, $board->currentPlayer());
        $board->playerChange();
        $this->history[] = $cell_index;
    }

    public function back($board, $args = null)
    {
        if (empty($this->history)) return;

        $recent = array_pop($this->history);
        $board->put($recent, null);
    }
}

