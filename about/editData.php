<?php
require_once "../connection/dbcon.php";
require_once "edit.php";
if (isset($_POST['companyID']) && isset($_POST['submit'])) {
    echo $name = $_POST['name'];
    echo $address = $_POST['address'];
    echo $postal = $_POST['postalID'];
    echo $phone = $_POST['phone'];
    echo $email = $_POST['email'];
    echo $companyDesc = $_POST['description'];
    echo $companyID = $_POST['companyID'];
    

    $dbCon = dbCon();
    $query = $dbCon->prepare("UPDATE company SET `name`='$name', `address`='$address', `postal`='$postalID', `phone`='$phone', `email`='$email', `description`='$companyDesc' WHERE ID=$companyID");
    $query->execute();
    //header("Location: aboutUs.php?status=updated&ID=$companyID");

}else{
    //header("Location: aboutUs.php?status=0");
}