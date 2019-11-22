<?php

require './db.php';
$db = new db();

$name = $_POST['name'];
$tel = $_POST['tel'];
$description = $_POST['description'];
$email = $_POST['email'];
$address = $_POST['address'];
$type = $_POST['type'];
$id = str_replace("card-comp","",$_GET['id']);


$sql = "UPDATE tbl_company SET company_name = $name, company_tel = $tel ,company_description = $description,company_email = $email,
company_address = $address,  company_type = $type
where company_id = $id";

mysqli_query($db->connection,$sql);

?>