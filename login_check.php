<?php

session_start();
ob_start();

include_once 'connection.php';

$connection = new createConnection();
$connection->connectToDatabase();
$connection->selectDatabase('test');

extract($_POST);


$myusername = stripslashes($username);
$mypassword = stripslashes($password);

$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$enc = md5($mypassword);

$sql = "SELECT * FROM tablo WHERE username='$myusername' and password='$enc'";



$result = mysql_query($sql);


$count = mysql_num_rows($result);


if ($count == 1) {



    $_SESSION["user"] = $myusername;
    $_SESSION["authentication"] = 1;

    /* while ($row = mysql_fetch_row($result)) {

      $username = $row[0];
      $city = $row[3];
      } */

//$_SESSION["typeofuser"] = user_type;

    header("Location:main.php");
    $connection->closeConnection();

    exit;
} else {


    error_log("authentication failed: no such user or password: $myusername - $ip_gelen");

    header("Location:login.php?error=1");
    $connection->closeConnection();
    exit;
}
?>