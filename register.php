<?php
ob_start();
include_once 'connection.php';

$connection = new createConnection();
$connection->connectToDatabase();
$connection->selectDatabase('test');


echo ' <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';


extract($_POST);

$uname= $username;
$passw = $password;
$password_clue = $cpassword;




if (  (preg_match("/[\-]{2,}|[=]|[;]|[']|[\\\*]/", $passw)) ||
      (preg_match("/[\-]{2,}|[=]|[;]|[']|[\\\*]/", $uname)) ||
      (preg_match("/[\-]{2,}|[=]|[;]|[']|[\\\*]/", $password_clue))
   
      
   ) {

header("Location:login.php?error=2");
// echo "<META http-equiv=\"refresh\" content=\"0.01;URL=signup.php?$error\">";
}

//empty stringcheck
if ( !(isset($mypassword)) || !(isset($mypassword_clue)) || !(isset($username))) {
    header("Location:login.php?error=emptyfield");
    exit;
}


//Username check
$myusername = stripslashes($uname);
$myusername = mysql_real_escape_string($myusername);

$usernameCheck = "select * from tablo  where username = ".$myusername;

$resultCheck = mysql_query($usernameCheck);


$countCheck = @mysql_num_rows($resultCheck);


if ($countCheck == 1) {
    //Conflict on demanded username
    header("Location:login.php?error=username");
    exit;
}



$mypassword = stripslashes($passw);
$mypassword_clue = stripslashes($password_clue);

$mypassword = mysql_real_escape_string($mypassword);
$mypassword_clue = mysql_real_escape_string($mypassword_clue);


$sql = "insert into kayit (username,password,cpassword) 
VALUES('$myusername','$mypassword','$mypassword_clue');";

$check = mysql_query($sql);
if ($check == true) {



echo "Kaydınız başarılı bir şekilde alınmıştır. İncelendikten sonra en kısa zamanda size geri dönüş yapılacaktır. Teşekkürler";

echo"<br><br>Birazdan giriş sayfamıza yönlendirileceksiniz...";
$connection->closeConnection();
echo "<META http-equiv=\"refresh\" content=\"5;URL=login.php\">";
} else {
$connection->closeConnection();
echo "<META http-equiv=\"refresh\" content=\"0.01;URL=login.php?error=cannotwrite\">";

exit;
}

$connection->closeConnection(); //closeConnection();


?>