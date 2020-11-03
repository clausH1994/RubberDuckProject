<?php
require_once "../connection/dbcon.php";
if (isset($_GET['ID'])) {
    $companyID = $_GET['ID'];
    $dbCon = dbCon();
    $query = $dbCon->prepare("DELETE FROM Company WHERE companyID=$companyID");
    $query->execute();

    header("Location: aboutUs.php?status=deleted&ID=$companyID");
}else{
    header("Location: aboutUs.php?status=0");
}