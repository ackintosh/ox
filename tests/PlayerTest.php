<?php

class PlayerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->player = new Player();
    }

    /**
     * @test
     */
    public function initial_player_is_o()
    {
        $this->assertSame('o', $this->player->current());
    }

    /**
     * @test
     */
    public function change_current_player()
    {
        $this->assertSame('o', $this->player->current());
        $this->player->change();
        $this->assertSame('x', $this->player->current());
        $this->player->change();
        $this->assertSame('o', $this->player->current());
    }
}
