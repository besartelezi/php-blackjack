<?php

declare(strict_types=1);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';

session_start();
if(isset($_SESSION['newGame']))
{
    $newGame = unserialize($_SESSION['newGame']);
}
else
{
    $newGame = new Blackjack();
    $_SESSION['newGame'] = serialize($newGame);
}

$deck = new Deck();
$deck->shuffle();
foreach($deck->getCards() AS $card) {
    echo $card->getUnicodeCharacter(true);
    echo '<br>';
}

echo $newGame->getPlayer()->hasLost() ? 'true' : 'false';

if (isset($_POST['hit']))
{
    $newGame->getPlayer()->hit($newGame->getDeck());
}

if (isset($_SESSION))
{
    echo "<br>";
    echo "The Player's score is: ";
    echo $newGame->getPlayer()->getScore();
    echo "<br>";
    echo "The Dealer's score is: ";
    echo $newGame->getDealer()->getScore();
}

if (isset($_POST))
if ($newGame->getPlayer()->hasLost() === true) {
    echo "loser";
}

?>





<form action ="index.php" method="post">
    <button type="submit" name ="hit" value ="hit">Hit</button>
    <button type="submit" name ="stand" value ="stand">Stand</button>
    <button type="submit" name ="surrender" value ="surrender">Surrender</button>
</form>
