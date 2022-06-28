<?php
declare(strict_types=1);

class Blackjack
{
    private Player $player;
    private Player $dealer;
    private Deck $deck;

    function __construct()
    {
        $deck = new Deck();
        $deck->shuffle();
        $this->player = new Player($deck);
        $this->dealer = new Player($deck);

    }

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


}
