<?php
    require '../db.php';
    $db = new db();

    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $description = $_POST['description'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $type = $_POST['type'];

    $date = date('Y-m-d h:m:s', time());
    $date = "\"" . $date .  "\"";
    $name = "\"" . $name .  "\"";
    $description= "\"" . $description .  "\"";
    $email = "\"" . $email .  "\"";
    $address = "\"" . $address .  "\"";
    $type = "\"" . $type .  "\"";


    var_dump($date);



    $sql = "INSERT into tbl_company (company_name,company_type,company_tel,company_date_added,company_last_update,company_description,company_email,company_address)
    VALUES($name,$type,$tel,$date,$date,$description,$email,$address)";
    $submit = $_POST['submit'];
    $recordAdded = "";


//if record added successfully redirect them to board and display message
    if ($sql){
         header("Location: ../board.php");
         session_start();
         $_SESSION['recordAdded'] = " Record added successfully";

//else display this message
     }else{
         session_start();
         $_SESSION['recordAdded'] =  "problem adding data";
    }


    mysqli_query($db->connection,$sql);
    echo mysqli_error($db->connection);


?>
