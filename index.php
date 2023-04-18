<?php
session_start();

    include ("connections.php");
    include ("functions.php");

    $user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hangman! Game</title>

    <link rel="stylesheet" href="game.css">

</head>

<a href="logout.php">Logout</a>
<h1>Hangman! Level Selector</h1>
<html>
<head>
    <link rel="stylesheet" href="game.css">
    <meta charset="UTF-8">
    <title>Hangman</title>
</head>
<body>

<div class="navigationBar">
    <a class="active" href="login.php">Home</a>
    <a href="Level1.php">LEVEL 1</a>
    <a href="Level2.php">LEVEL 2</a>
    <a href="Level3.php">LEVEL 3</a>
    <a href="Level4.php">LEVEL 4</a>
    <a href="Leaderb.html">LEADERBOARD</a>

</div>
</body>
</html>
