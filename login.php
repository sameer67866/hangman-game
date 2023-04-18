<?php
session_start();

include ("connections.php");
include ("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if(!empty($user_name) && !empty($password) && !is_numeric($user_name)){

        //

        $query = "select * from users where user_name = '$user_name' limit 1";
        $result = mysqli_query($con, $query);

        if($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] === $password){
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: index.php");
                    dies;
                }

            }
        }
        echo "The Password or Username you entered is not correct";

    }
    else{
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
    <title>Hangman! Login</title>
</head>
<body>

<h1>Hangman login page</h1>
<br>

    <div id="box">

        <form method="post" style="text-align: center;">
            <div style="font-size: 30px; margin: 20px; color: black;">Login</div>
            <input type="text" name="user_name"><br><br>
            <input type="password" name="password"><br><br>
            <input type="submit" name="Login"><br><br>
            <a href="signup.php">Signup</a><br><br>
        </form>
    </div>

</body>
</html>

