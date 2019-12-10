<?php
    //Create database object
    session_start();
    require '../db.php';
    $db = new db();
    //Get user input
    $enteredPassword = $_POST['password'];
    $enteredUsername = $_POST['username'];
    // Get result of login
    $login = $db->loginUser($enteredUsername,$enteredPassword);

    if ($login == true) // Authenticated login
    {
        $_SESSION['username'] = $enteredUsername;
        header("location: ../board.php");
    }else { // Login failed
        $_SESSION['error'] = "Login failed.";
        header("location: ../index.php");
    }

?>