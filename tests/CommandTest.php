<?php
require_once 'OX_TestCase.php';

class CommandTest extends OX_TestCase
{
    public function setUp()
    {
        $this->command = new Command();
        $this->board   = new Board(new Player(), new Command());
    }

    /**
     * @test
     */
    public function choose_assigns_player_to_passed_index()
    {
        $this->command->choose($this->board, 1);
        $board = $this->getPrivateProperty($this->board, 'board');
        $this->assertTrue($board[0][0] !== null);

        $this->command->choose($this->board, 5);
        $board = $this->getPrivateProperty($this->board, 'board');
        $this->assertTrue($board[1][1] !== null);
    }

    /**
     * @test
     */
    public function back_assign_null_to_last_input()
    {
        $this->command->choose($this->board, 5);
        $this->command->back($this->board);
        $board = $this->getPrivateProperty($this->board, 'board');
        $this->assertNull($board[1][1]);
    }
}
