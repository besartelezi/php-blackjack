# BlackJack, but make it PHP
For this challenge, I have to create a blackjack game in PHP, while also writing the code according to the rules of OOP.
This means using lots of classes and objects, something I really want to keep on practicing.
I have already made a blackjack game in Javascript, so I can focus more on the OOP side of this assignment and not so much on figuring out the rules of the game.

If you want to play the Javascript blackjack game I made, [then you can click here and play away!](https://besartelezi.github.io/js-21-card-game/) <br>
But if you're more interested in checking out the repository of the JS blackjack game, [then you can check it out here!](https://github.com/besartelezi/js-21-card-game)

The coaches at BeCode have provided some clear instructions for us to follow, which will be shown down below.

## Instructions

### Blackjack Rules
- Cards are between 1-11 points.
    - Faces are worth 10
    - Ace is always worth 11
- Getting more than 21 points, means that you lose.
- To win, you need to have more points than the dealer, but not more than 21.
- The dealer is obligated to keep taking cards until they have at least 15 points.
- We are not playing with blackjack rules on the first turn (having 21 on first turn) - we leave this up to you as a nice to have.

#### Flow
- A new deck is shuffled
- Player and dealer get 2 random cards
- Dealer shows first card he drew to player
- Player either keeps getting hit (asks for more cards), or stands down.
- If the player at any point goes above 21, he automatically loses.
- Once the player is done the dealer keeps taking cards until he has at least 15 points. If he hits above 21 he automatically loses.
- At the end display the winner

### Instructions
#### Creating the base classes
- [x] Create a class called `Player` in the file `Player.php`.
- [x] Add 2 private properties:
  - [x] `cards` (array)
  - [x] `lost` (bool, default = false)
- [x] Add a couple of empty public methods to this class:
  - [x]  `hit`
  - [x]  `surrender`
  - [x]  `getScore`
  - [x]  `hasLost`
- [x] Create a class called `Blackjack` in the file `Blackjack.php`
- [x] Add 3 private properties
  - [x]  `player` (Player)
  - [x]  `dealer` (Player for now)
  - [x]  `deck`  (Deck)
- [x] Add the following public methods:
  - [x]  `getPlayer` (returns the `player` object)
  - [x]  `getDealer` (returns the `dealer` object)
  - [x]  `getDeck` (returns the `deck` object)
- [x] In the [constructor](https://www.php.net/manual/en/language.oop5.decon.php) do the following:
  - [x]  Instantiate the Player class twice, insert it into the `player` property and a `dealer` property.
  - [x]  Create a new [`deck` object](code/Deck.php) (code has already been written for you!).
  - [x]  Shuffle the cards with `shuffle` method on `deck`.
- [ ] In the [constructor](https://www.php.net/manual/en/language.oop5.decon.php) of the `Player` class;
  - [x]  Make it expect the `Deck` object as a parameter.
  - [x]  Pass this `Deck` from the `Blackjack` constructor.
      * `$this->player = new Player($deck);`
        * Putting the $deck inside of the brackets in the new Player is the way to go for this step
  - [x]  Now draw 2 cards for the player. You have to use an existing method for this from the Deck class.
       - Unsure of this step  
- [x] Go back to the `Player` class and add the following logic in your empty methods:
  - [x]  `getScore` loops over all the cards and return the total value of that player.
  - [x]  `hasLost` will return the bool of the lost property.
  - [x]  `hit` should add a card to the player. If this brings him above 21, set `lost` property to `true`. To count his score use the method `getScore` you wrote earlier. This method should expect the `$deck` variable as an argument from outside, to draw the card.
       - Unsure of this step
       - [ ]  (optional) For bonus points make the number 21 a class constant: this is a [magical value](https://stackoverflow.com/questions/47882/what-is-a-magic-number-and-why-is-it-bad) we want to avoid.
  - [x]  `surrender` should make you surrender the game. (Dealer wins.)
    This sets the property `lost` in the `player` instance to true.
  - [x]  `stand` does not have a method in the player class but will instead call hit on the `dealer` instance. (you have to do nothing here)
     - Unsure of this step
#### Creating the index.php  file

- [ ]  Create an index.php file with the following code:
  - [x]  Require all the files with the classes you already created. Ideally you want a seperate file for each class.
  - [x]  Start the PHP session
  - [x]  If the session does not have a `Blackjack` variable yet:
     - [x]   Create a new `Blackjack` object.
     - [x]  Put the `Blackjack` object in the session
  - [ ]  Use buttons or links to send to the `index.php` page what the player's action is. (i.e. hit/stand/surrender)

#### Take a moment to enjoy the view
Everything from the player is now done! Job well done!

#### The dealer
So far we are assuming the player and dealer play with the same rules, hence they share a class. There is of course an important difference: the dealer does keep playing with the function `hit` until he has at least 15.

- [ ] To change this behavior, we have are going [extend](https://www.php.net/manual/en/language.oop5.inheritance.php) the `player` class and extend it to a newly created `dealer` class.
- [ ] Change the `Blackjack` class to create a new `dealer` object instead of a `player` object for the property of the dealer.
- [ ] Now create a `hit` function that keeps drawing cards until the dealer has at least 15 points. The tricky part is that we also need the `lost` check we already had in the `hit` function of the player. We could just copy the code but duplicated code is never the solution, instead you can use the following code to call the old `hit` function:

```parent::hit();```

#### Final push
All classes are ready, now you just need to write some minimal glue in the `index.php`. The final result should be the following:

- [ ] When you the **hit** button call `hit` on player, then check the lost status of the player.
   You will need to pass a `Deck` variable to this function, you can use the `Blackjack::getDeck()` method for this.
- [ ] When you the **stand** button call `hit` on dealer, then check the lost status of the dealer. If he is not lost, compare scores to set the winner (If equal the dealer wins).
- [ ] **Surrender**: the dealer auto wins.
- [ ] Always display on the page the scores of both players. If you have a winner, display it.
- [ ] End of the game: destroy the current `blackjack` variable so the game restarts.

# Nice to have
- [ ] Implement a betting system
    - [ ] Every new player (new session) starts with 100 chips
    - [ ] After the player gets his 2 first cards every round ask how much he wants to bet. He needs to bet at least 5 chips.
    - [ ] If the player wins the bet he gains double the amount of chips.
- [ ] Implement the blackjack first turn rule: if the player draws 21 the first turn: he directly wins. If the dealer draws 21 the first turn, he wins. If both draw it, it is a tie. 
    - [ ] When you implement both nice to have features, a blackjack means an auto win of 10 chips, a blackjack of the dealer a loss of 5 chips for the player.
    
#### Notes
- [ ] Final push: 1 & 2: miss the word "click"
- [ ] Nice to have: reveal of dealer cards at the end
- [ ] Change code in Card.php -> add css class
- [ ] -> add note to explain why we show the score of the dealer
- [ ] rename the "surrender" method to "lose"
- [ ] -> add a nice to have "catch going bust first 2 cards"

## [What's 9 + 10?](https://www.youtube.com/shorts/_MX-g3ErZA0)
The very first steps are just to create some private properties and public methods.
Methods are functions **inside** classes.
The issue I'm having here is that I'm unsure of what type of information the method has to handle, whether it be an int, strings, or arrays.
I will probably get a better idea of what the answer is once I've written some more code.

## Pre-Written Code: "Pros and Cons"
I'm feeling quite conflicted working on this challenge, and those feelings are caused by the fact that we're working with code that was provided for us by the coaches.
On one hand, I can use that code as an example of how I should work.
But on the other, I need to spend some time understanding the code and understanding how the entire Blackjack game will work once I'm done.
If I coded everything by myself from the start, it would've been a lot harder to start on the challenge, but I would've been following along quite better.

This was, in my opinion, done on purpose by the coaches.
This way we'll get some extra assistance with OOP, which is a difficult topic.
But we'll also learn to work on the code created by others.
This is something that we will most definitely experience a lot once we start working as Web Developers.
Understanding someone else's code can help you write more understandable code yourself in return.


#### Quick P.S. : The challenge is fun, and I love the fact that we're learning about OOP, but this is how the second half of the challenge has got me like:
![gon-gif](resources/smoke-gon.gif)

## 