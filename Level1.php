<?php

session_start();



function getimage($part){
    return "./images/hangman_". $part. ".png";
}

function getHangmanBody(){
    global $hangmanBody;
    return isset($_SESSION["bodyPieces"]) ? $_SESSION["bodyPieces"] : $hangmanBody;
}

function addHangmanPart(){
    $bodyPieces = getHangmanBody();
    array_shift($bodyPieces);
    $_SESSION["bodyPieces"] = $bodyPieces;
}

function bodyPieces(){
    $bodyPieces = getHangmanBody();
    return $bodyPieces[0];
}


$hangmanBody = ["Gallow","head","body","leftHand","rightHand","RightLeg","leftLeg"];


$words = ["APPLE","CAT", "CAR","THREE","MARCH"];

$clue =["What Keeps the doctor away", "Furry Friend" , "Common mode of transportation" , "Lucky Number" , "When does winter end?"];

$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$WON = false;

function getCurrentinput(){
    return isset($_SESSION["input"]) ? $_SESSION["input"] : [];
}


function getRandomWord(){
    global $words;

    if(!isset($_SESSION["word"]) ){
        $key = array_rand($words);
        $_SESSION["key"] = $key;

    }
    return $_SESSION["key"];
}

function sessionWord(){
    global $words;
    $Akey = getRandomWord();

    $_SESSION["word"] = $words[$Akey];

    return $_SESSION["word"];
}


function getCurrentClue(){
    global $clue;
    $index= getRandomWord();
    $_SESSION["clue"] = $clue[$index];
    echo $clue[$index];
    return $_SESSION["clue"];
}

if(isset($_GET['clue'])){
    getCurrentClue();
}



function addInput($letter){
    $input = getCurrentinput();
    array_push($input, $letter);
    $_SESSION["input"] = $input;
}

function checkLetterInput($letter){
    $word = sessionWord();
    $wordLen = strlen($word) - 1;
    for($i=0; $i<= $wordLen; $i++){
        if($letter == $word[$i]){
            return true;
        }
    }
    return false;
}


function isWordCorrect(){
    $guess = sessionWord();
    $input = getCurrentinput();
    $wordLen = strlen($guess) - 1;
    for($i=0; $i<= $wordLen; $i++){
        if(!in_array($guess[$i],  $input)){
            return false;
        }
    }
    return true;
}


function checkBodyParts(){

    $bodyPieces = getHangmanBody();
    if(count($bodyPieces) <= 1){
        return true;
    }
    return false;
}

function endGame(){
    return isset($_SESSION["endSession"]) ? $_SESSION["endSession"] :false;
}


function gameComplete(){
    $_SESSION["endSession"] = true;
}

function newGame(){
    $_SESSION["endSession"] = false;
}

if(isset($_GET['KeyPressed'])){
    $lastKeyPressed = isset($_GET['KeyPressed']) ? $_GET['KeyPressed'] : null;
    if( !endGame() && !checkBodyParts() && checkLetterInput($lastKeyPressed) && $lastKeyPressed ){

        addInput($lastKeyPressed);
        if(isWordCorrect()){
            $WON = true;
            gameComplete();
        }
    }else{
        if(!checkBodyParts()){
            addHangmanPart();
            if(checkBodyParts()){
                gameComplete();
            }
        }else{
            gameComplete();
        }
    }
}
if(isset($_GET['start'])){
    restartHangman();
}
function restartHangman(){
    session_destroy();
    session_start();

}

?>

<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="game.css">
    <meta charset="UTF-8">
    <title>Hangman Level 1</title>
</head>
<body>
<h1>Hangman Level 1</h1>
<div class="translate">
    <img src="sticktrans.gif" alt="stick" height="5%"  width="5%">
</div>

<div class="navigationBar">
    <a class="active" href="login.php">Home</a>
    <a href="Level1.php">LEVEL 1</a>
    <a href="Level2.php">LEVEL 2</a>
    <a href="Level3.php">LEVEL 3</a>
    <a href="Level4.php">LEVEL 4</a>
    <a href="Leaderb.html">LEADERBOARD</a>

</div>


<div style="margin: 0 auto; width:900px; height:900px; padding:5px; border-radius:3px;">

    <div style="display:inline-block; width: 900px; height: 700px; background:#fff;">
        <img style="width:80%; display:inline-block;" src="<?php echo getimage(bodyPieces());?>">




        <?Php if(endGame()):?>
            <h1 style="color: white;">GAME COMPLETE</h1>
        <?php endif;?>
        <?php if($WON  && endGame()):?>
            <p style="color: lawngreen; font-size: 40px;">You Won, Congrats! Please Go To Next Level</p>
        <?php elseif(!$WON  && endGame()): ?>
            <p style="color: red; font-size: 40px;">You LOST, Please Restart Game</p>
        <?php $ANSWER= sessionWord();
        echo $ANSWER;
            ?>
        <?php endif;?>
    </div>

    <div style="float:none; display:inline; vertical-align:top;">
        <h1 style="color: white;">Hangman the Game</h1>
        <div style="display:inline-block;">
        </div>
        <div style="color: black; padding:10px; text-align: center; margin-top:5px;">
                <?php
                $guess = sessionWord();
                $maxLetters = strlen($guess) - 1;
                for($j=0; $j<= $maxLetters; $j++): $l = sessionWord()[$j]; ?>
                    <?php if(in_array($l, getCurrentinput())):?>
                        <span style="font-family: Verdana; font-size: 50px; border-bottom:5px solid #000; margin-right: 10px;"><?php echo $l;?></span>
                    <?php else: ?>
                        <span style="font-family: Verdana; font-size: 50px; border-bottom:5px solid #000; margin-right: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <?php endif;?>
                <?php endfor;?>
            </div>
        </div>
    </div>
    <form method="get" style="text-align: center";>
        <?php
        $wordLen = strlen($letters) - 1;
        for($i=0; $i<= $wordLen; $i++){
            echo "<button class='letters' type='submit' name='KeyPressed' value='". $letters[$i] . "'>".
                $letters[$i] . "</button>";
            if ($i % 7 == 0 && $i>0) {
                echo '<br>';
            }
        }
        ?>
        <br><br>
        <button class='letters' type="submit" name="start">Restart Game</button>
        <button class='letters' type="submit" name="clue">Clues</button>
    </form>
</div>
</body>
</html>