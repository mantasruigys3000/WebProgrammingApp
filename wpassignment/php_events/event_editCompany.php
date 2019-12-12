<?php

require '../db.php';
$db = new db();
//Get user input from post
$name = $_POST['name'];
$tel = $_POST['tel'];
$description = $_POST['description'];
$email = $_POST['email'];
$address = $_POST['address'];
$type = $_POST['type'];
$id = str_replace("card-comp","",$_GET['id']);
//Get date and wrap input in quotes

// Change quotes in description
$description = str_replace("\"","'",$description);


$date = date('Y-m-d h:m:s', time());
$date = "\"" . $date .  "\"";
$name = "\"" . $name .  "\"";
$tel = "\"" . $tel .  "\"";
$description= "\"" . $description .  "\"";
$email = "\"" . $email .  "\"";
$address = "\"" . $address .  "\"";
$type = "\"" . $type .  "\"";



// Update the company using database object
$result = $db->updateCompany($id,$name,$type,$tel,$date,$description,$email,$address);

// Check result of the query
if ($result){
    header("Location: ../board.php");
   
    $_SESSION['message'] = "Record updated successfully.";
    
}else{
    header("Location: ../edit.php?id=".$id);
    $_SESSION['message'] = "There was an error updating this record.";
}

?>