<?php

declare(strict_types=1);

require 'Suit.php';
require 'Card.php';
require 'Deck.php';
require 'Player.php';
require 'Blackjack.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BlackJack with JackBlack</title>
</head>
<body>
<form action ="index.php" method="post">
    <button type="submit" name ="hit" value ="hit">Hit</button>
    <button type="submit" name ="stand" value ="stand">Stand</button>
    <button type="submit" name ="surrender" value ="surrender">Tactical Retreat</button>
    <button type="submit" name ="game" value ="game">Try again!</button>
</form>

<?php

//Starts session
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

//Current issue is: player can only hit once, not multiple times, need to see what the issue is.
//Also, the hasLost is constantly set wrong, it's always true even when it's supposed to be false.
//Look at similarities between HIT, STAND, and SURRENDER

//Hit button of the player
if (isset($_POST['hit']))
{
    //If the player hasn't lost yet, he can press the button.
    //Once the player has lost, he can't use the button anymore.
    if (!$newGame->getPlayer()->hasLost())
    {
        $newGame->getPlayer()->hit($newGame->getDeck());
        //line 41 = something that will happen to all functions, how can we write this without rewriting code?
        $_SESSION['newGame'] = serialize($newGame);
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}

//When the player loses, the following happens
if ($newGame->getPlayer()->hasLost())
{
    echo 'Play Again! Just try and win this time ok?';
}
//When the dealer loses, the following happens
elseif ($newGame->getDealer()->hasLost())
{
    echo 'Play Again!';
}

//The stand button
if (isset($_POST['stand']) && !$newGame->getPlayer()->hasLost())
{
    //activates the hit function of the dealer
    $newGame->getDealer()->hit($newGame->getDeck());
    //if both the dealer and the player haven't lost yet, meaning they're both not over 21, the following happens
    if (!$newGame->getDealer()->hasLost())
    {
        //if the dealer has a score that's equal to or higher than the player's score, the dealer wins
        if ($newGame->getDealer()->getScore() >= $newGame->getPlayer()->getScore())
        {
            $newGame->getPlayer()->setLost();
            echo 'The Dealer wins!';
        }
        //if that's not the case, then the player wins
        else
        {
            $newGame->getDealer()->setLost();
            echo 'GG EZ, you win!';
        }
    }
    else
    //But if the dealer gets above 21, the hit loop will stop, and the dealer will lose
    {
        $newGame->getDealer()->setLost();
        echo 'GG EZ, you win!';
    }
}

if(isset($_POST['surrender']) && !$newGame->getPlayer()->hasLost())
{
    $newGame->getPlayer()->setLost();
    echo "I have lost a bit of respect for you";
}

//The player's and dealer's scores are visible
if (isset($_SESSION))
{
    echo "<br>";
    echo "The Player's score is: ";
    echo $newGame->getPlayer()->getScore();
    echo "<br>";
    echo "The Dealer's score is: ";
    //If the dealer or the player has lost, the dealer's score will be visible
    if ($newGame->getDealer()->hasLost() || $newGame->getPlayer()->hasLost())
    {
        echo $newGame->getDealer()->getScore();
    }
    //if not, then the dealers score will be hidden
    else
    {
        echo "?";
    }}

//pressing the play again button, destroys the session and resets to the index
if (isset($_POST['game'])) {
    session_destroy();
    //If I don't add this piece of code that resets to the index, then, when the player has over 21, the play again button will only work if you press it twice
    header('Location: index.php');
}
?>

</body>
</html>
