<?php
header('Content-Type: text/html; charset=utf-8');
include "include/connection.php";
include "include/functions.php";
include "include/classes.php";
require_once "Mail.php";
session_start();



    
$myemail = $_POST['aaEmail'];
//$succ = array();
 
//send a request to the database
$sql = "SELECT * FROM users WHERE useremail = '$myemail'";
$result = mysqli_query($connection,$sql);
 
if(mysqli_num_rows($result) > 0) {
    //email is already taken
    //$succ['isTaken'] = "0";
    //echo json_encode($succ);
    echo 0;
}
else {
    //email is available
    //$succ['isTaken'] = "1";
    //echo json_encode($succ);
    echo 1;
}




?>