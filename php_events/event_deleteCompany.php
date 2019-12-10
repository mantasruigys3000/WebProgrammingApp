<?php

require '../db.php';
$db = new db();

$id = str_replace("card-comp","",$_GET['id']);

$sql = $db->deleteCompany($id);





if ($sql){
    header("Location: ../board.php");
    $_SESSION['message'] = "Record deleted successfully.";
}else{
    header("Location: ../edit.php?id=".$id);
    $_SESSION['message'] = "There was an error deleting this record.";
}

?>