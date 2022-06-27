<?php
declare(strict_types=1);

class Blackjack
{
    private Player $player;
    private Player $dealer;
    private Deck $deck;

    public function getPlayer ()
    {
        return $this->player;
    }

    public function getDealer ()
    {
        return $this->dealer;
    }

    public function getDeck ()
    {
        return $this->deck;
    }


    function __construct()
    {
        $this->player = new Player($this->Ddeck);
        $this->dealer = new Player($this->deck);
        $deck = new Deck();
        $deck->shuffle();
    }


}
