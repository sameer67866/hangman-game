<?php
session_start();

    include ("connections.php");
    include ("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){

            $user_id = random_num(20);
            $query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

            mysqli_query($con, $query);

            header("Location: login.php");
            dies;

        }else{
            echo "Please enter valid information";
        }
    }

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="game.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hangman! Signup</title>
</head>
<body>

<h1>Hangman Signup page</h1>
<br>

<div id="box">

    <form method="post" style="text-align: center;">
        <div style="font-size: 30px; margin: 20px; color: black;">Signup</div>
        <input type="text" name="user_name"><br><br>
        <input type="password" name="password"><br><br>
        <input type="submit" name="Login"><br><br>
        <a href="login.php">Login</a><br><br>
    </form>
</div>

</body>
</html>