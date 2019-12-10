<?php

require '../db.php';
$db = new db();

$name = $_POST['name'];
$tel = $_POST['tel'];
$description = $_POST['description'];
$email = $_POST['email'];
$address = $_POST['address'];
$type = $_POST['type'];
$id = str_replace("card-comp","",$_GET['id']);

$date = date('Y-m-d h:m:s', time());
$date = "\"" . $date .  "\"";
$name = "\"" . $name .  "\"";
$tel = "\"" . $tel .  "\"";
$description= "\"" . $description .  "\"";
$email = "\"" . $email .  "\"";
$address = "\"" . $address .  "\"";
$type = "\"" . $type .  "\"";




$result = $db->updateCompany($id,$name,$type,$tel,$date,$description,$email,$address);


if ($result){
    header("Location: ../board.php");
   
    $_SESSION['message'] = "Record updated successfully.";
    
}else{
    header("Location: ../edit.php?id=".$id);
    $_SESSION['message'] = "There was an error updating this record.";
}

?>