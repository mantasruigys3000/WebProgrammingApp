<?php
    //Create database object
    require '../db.php';
    $db = new db();
    // Get all input from post
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $type = $_POST['type'];

    // Change quotes in description
    $description = str_replace("\"","'",$description);
    // Get date and wrap input
    $date = date('Y-m-d h:m:s', time());
    $date = "\"" . $date .  "\"";
    $name = "\"" . $name .  "\"";
    $description= "\"" . $description .  "\"";
    $email = "\"" . $email .  "\"";
    $address = "\"" . $address .  "\"";
    $type = "\"" . $type .  "\"";

    //insert the company using database method
    $result = $db->insertCompany($name,$type,$tel,$date,$description,$email,$address);

    
    $submit = $_POST['submit'];



//if record added successfully redirect them to board and display message
    if ($result){
         header("Location: ../board.php");
         session_start();
         $_SESSION['message'] = "Record added successfully";

//else display this message
     }else{
        header("Location: ../board.php");
         session_start();
         $_SESSION['message'] =  "Problem adding this record.";
    }

?>
