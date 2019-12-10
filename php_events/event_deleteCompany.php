<?php

// Create the database object
require '../db.php';
$db = new db();


$id = str_replace("card-comp","",$_GET['id']); // get id of company
$sql = $db->deleteCompany($id); // delete company




// check if method was successful
if ($sql){
    header("Location: ../board.php");
    $_SESSION['message'] = "Record deleted successfully.";
}else{
    header("Location: ../edit.php?id=".$id);
    $_SESSION['message'] = "There was an error deleting this record.";
}

?>