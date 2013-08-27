<?php
require_once 'OX_TestCase.php';

class BoardTest extends OX_TestCase
{
    public function setUp()
    {
        $this->board = new Board(new Player(), new Command());
    }

    /**
     * @test
     */
    public function cells_on_board_should_be_null_when_initialized()
    {
        $expect = [
            [null, null, null],
            [null, null, null],
            [null, null, null],
            ];

        $this->assertSame($expect, $this->getPrivateProperty($this->board, 'board'));
    }

    /**
     * @test
     */
    public function isValidChoise_returns_true_if_cell_is_null()
    {
        $this->assertTrue($this->board->isValidChoise(1));
        $this->assertTrue($this->board->isValidChoise(9));
    }

    /**
     * @test
     */
    public function isValidChoise_returns_false_if_passed_negative_or_zero()
    {
        $this->assertFalse($this->board->isValidChoise(0));
        $this->assertFalse($this->board->isValidChoise(-1));
    }

    /**
     * @test
     */
    public function isValidChoise_returns_false_if_passed_over_9()
    {
        $this->assertFalse($this->board->isValidChoise(10));
    }

    /**
     * @test
     */
    public function put_assigns_player_to_passed_index()
    {
        $this->board->put(1, 'x');
        $board = $this->getPrivateProperty($this->board, 'board');
        $this->assertTrue($board[0][0] === 'x');
    }

    /**
     * @test
     */
    public function isFilled_returns_true_if_board_filled()
    {
        foreach (range(1, 9) as $n) {
            $this->board->put($n, 'x');
        }
        $this->assertTrue($this->board->isFilled());
    }

    /**
     * @test
     */
    public function isFilled_returns_false_if_board_has_null()
    {
        $this->assertFalse($this->board->isFilled());
    }

    /**
     * @test
     * @dataProvider isAlignedProvider
     */
    public function isAligned_returns_true_if_board_is_aligned($data)
    {
        $board = new Board(new Player(), new Command());
        foreach ($data as $d) {
            $board->put($d, 'x');
        }

        $this->assertTrue($board->isAligned());
    }

    public function isAlignedProvider()
    {
        return [
            [
                [1, 2, 3],
            ],
            [
                [4, 5, 6],
            ],
            [
                [7, 8, 9],
            ],
            [
                [1, 4, 7],
            ],
            [
                [2, 5, 8],
            ],
            [
                [3, 6, 9],
            ],
            [
                [1, 5, 9],
            ],
            [
                [3, 5, 7],
            ],
            ];
    }
}
