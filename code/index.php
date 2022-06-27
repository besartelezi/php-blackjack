<?php

declare(strict_types=1);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';

session_start();
$blackjackObject = new Blackjack();
$_SESSION['sample'] = serialize($blackjackObject);


if(isset($_GET['page'])){
    switch($_GET['page']) {
        case 'classes' :
            require '.php';
            break;
        case 'extending' :
            require 'exercise_2_extending.php';
            break;
        case 'private' :
            require 'exercise_3_private.php';
            break;
        default :
            echo 'Hmmm whatcha say, Hmmm that you only meant to see a page? Well of course you did.';
    }
}
