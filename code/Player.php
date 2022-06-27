<?php
declare(strict_types=1);

class Player
{
    private array $cards;
    private bool $lost = false;

    public function hit ($deck)
    {
        $this->deck->drawCard($this->player);
        if ($this->getScore() > 21) {
            $this->lost = true;
        }
    }

    public function surrender () :bool
    {
        $this->lost = true;
        return $this->lost;
    }

//getScore has to:
//Loop over all the cards, get the total value of the cards of the player and returns that value to the player
    public function getScore () :int
    {
        $sum = 0;
        for ($i =0; count($this->cards) > $i ; $i++ )
        {
            $sum += $this->cards[$i]->getRawValue();

        }
        return $sum;
    }

    public function hasLost () :bool
    {
        return $this->lost;
    }

    public function __construct($deck)
    {

    }
}