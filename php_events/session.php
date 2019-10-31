<?php
require 'db.php'
$db = new db();
   session_start();
   $user_check = $_SESSION['username'];
   //checks to see if the username in the database is the same as the $session varible
   $sql = $db-> connnection->query("SELECT user_username from tbl_user where  user_username = '$user_check' ");
   $row = mysqli_fetch_array($sql);
   $login_session = $row['username'];
   //if not session varible take user back to login
   if(!isset($_SESSION['username'])){
      header("location:../index.php");

}

  ?>
