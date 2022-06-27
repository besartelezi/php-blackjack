<?php
declare(strict_types=1);

class Blackjack
{
    private Player $player;
    private Player $dealer;
    private Deck $deck;

    public function getPlayer () :Player
    {
        return $this->player;
    }

    public function getDealer () :Player
    {
        return $this->dealer;
    }

    public function getDeck () :Deck
    {
        return $this->deck;
    }

    public function __construct()
    {
        $this->player = new Player();
        $this->dealer = new Player();
    }
}