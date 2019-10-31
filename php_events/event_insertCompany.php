<?php
    require '../db.php';
    $db = new db();

    $sql = "INSERT into tbl_company (company_name,company_tel,company_date_added,company_last_update,company_description,company_email)
    VALUES($_POST[""],'+44 7700 900825','2019-10-31 14:28:00','2019-10-31 14:28:00','The International Business Machines Corporation is an American multinational information technology company headquartered in Armonk, New York, with operations in over 170 countries.','help@ibm.co.uk
    ')";


?>