<?php
session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "LOGIN_PAGE";

if (!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die(" failed to connect :( ");
}


?>