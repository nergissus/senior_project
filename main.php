<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( $_SESSION["authentication"] == 1 && isset($_SESSION["user"])) {
    
    
    //echo "Welcome ".$_SESSION["user"];
    echo "Welcome {$_SESSION["user"]}";
    
  
}

?>


