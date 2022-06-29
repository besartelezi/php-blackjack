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
    <button type="submit" name ="surrender" value ="surrender">Surrender</button>
</form>
</body>
</html>

<?php

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

if (isset($_POST['hit']))
{
    if (!$newGame->getPlayer()->hasLost())
    {
        $newGame->getPlayer()->hit($newGame->getDeck());
        //line 41 = something that will happen to all functions, how can we write this without rewriting code?
        $_SESSION['newGame'] = serialize($newGame);
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
}

if ($newGame->getPlayer()->hasLost())
{
    echo '<button>Play Again! Just try and win this time ok?</button>';
}
elseif ($newGame->getDealer()->hasLost())
{
    echo '<button>Play Again!</button>';
}


if (isset($_POST['stand']))
{
    $newGame->getDealer()->hit($newGame->getDeck());
    //find a way to not repeat this line of code
    $_SESSION['newGame'] = serialize($newGame);
    header('Location: '.$_SERVER['PHP_SELF']);
    if (!$newGame->getDealer()->hasLost())
    {
        if ($newGame->getDealer()->getScore()>= $newGame->getPlayer()->getScore())
        {
            echo 'The Dealer wins!';
        }
        else
        {
            echo 'GG EZ, you win!';
        }
    }
}

if (isset($_SESSION))
{
    echo "<br>";
    echo "The Player's score is: ";
    echo $newGame->getPlayer()->getScore();
    echo "<br>";
    echo "The Dealer's score is: ";
    if ($newGame->getDealer()->hasLost() || $newGame->getPlayer()->hasLost())
    {
        echo $newGame->getDealer()->getScore();
    }
    else
    {
        echo "?";
    }
}

?>