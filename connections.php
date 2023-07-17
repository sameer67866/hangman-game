<?php
session_start();

$dbhost = "localhost";
$dbuser = "if0_34628781";
$dbpass = "IMy94p0d1vcG";
$dbname = "if0_34628781_abc";


if (!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die(" failed to connect :( ");
}


?>
