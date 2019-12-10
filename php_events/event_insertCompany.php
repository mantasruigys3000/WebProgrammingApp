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


    mysqli_query($db->connection,$sql);
    echo mysqli_error($db->connection);


?>
