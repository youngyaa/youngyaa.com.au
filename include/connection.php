<?php
  $dbhost = "localhost";
  $dbuser = "youngyaa";
  $dbpass = "youngyaa123";
  $dbname = "youngyaa";
  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  $languageset = "set names utf8";
  mysqli_query($connection,$languageset);
  // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }

?>