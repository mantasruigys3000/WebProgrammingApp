<?php

    require '../db.php';
    $db = new db();

    $comapnies = $db->getCompanies;
    $company = $comapnies[0];
    $firstCompanyName = $company["name"];


    // get all companies
   
    

?>