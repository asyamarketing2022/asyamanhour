<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once("Userslog.php");
include_once("connections/connection.php");
$con = connection();

// include_once("user-record.php");

// User Record Action Logout

// userRecord('logout');
$logout = new Userslog('logout');
$logout->userRecord();

unset($_SESSION['UserLogin']);
echo header("Location: index.php");


?>