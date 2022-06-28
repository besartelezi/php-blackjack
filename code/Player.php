<?php
declare(strict_types=1);

class Player
{
    protected array $cards;
    protected bool $lost = false;

    public function __construct($deck)
    {
        $this->cards[] = $deck->drawCard();
        $this->cards[] = $deck->drawCard();
    }

    public function hit ($deck)
    {
        $this->cards = $deck->drawCard();
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
}
class Dealer extends Player
{
    public function __construct($deck)
    {
        parent::__construct($deck);
    }

    public function hit ($deck)
    {
        // if the current score of the dealer is smaller than 14 or equal to 14, the dealer will keep hitting
        if ($this->getScore() <= 14)
            //this loops the hit function that we made earlier, but for the dealer
            //we did not have to rewrite any code because this is the child class and the function was already made in the parent class
            //the $this->getScore part is not that important, it just needs to loop enough times and I used this method in order to not hardcode anything
            for ($i=0; $i < $this->getScore(); $i++)
            {
                parent::hit($deck);
            }
    }

}