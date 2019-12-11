<?php
//session msut be started before the session is destroyed
session_start();
//if session destroyed return user to login page(index.php)
if(session_destroy()) {
   header("Location: index.php");
}
?>
