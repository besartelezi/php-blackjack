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


?>
<form action ="Player.php" method="get">
    <button type="submit" name ="hit" value ="hit">Hit</button>
    <button type="submit" name ="stand" value ="stand">Stand</button>
    <button type="submit" name ="surrender" value ="surrender">Surrender</button>
</form>
