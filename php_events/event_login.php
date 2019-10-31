<?php
    session_start();
    require '../db.php';
    
    $db = new db();
    $enteredPassword = $_POST['password'];
    $enteredUsername = $_POST['username'];
    $login = $db->loginUser($enteredUsername,$enteredPassword);

    if ($login == true)
    {
        $_SESSION['username'] = $enteredUsername;
        header("location: ../board.php");
    }else {
        $_SESSION['error'] = "Login failed.";
        header("location: ../index.php");
    }

?>