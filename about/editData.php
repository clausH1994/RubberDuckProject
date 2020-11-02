<?php
require_once "../connection/dbcon.php";
if (isset($_POST['companyID']) && isset($_POST['submit'])) {
    echo $name = $_POST['name'];
    echo " ";
    echo $address = $_POST['address'];
    echo " ";
    echo $postal = $_POST['postalID'];
    echo " ";
    echo $phone = $_POST['phone'];
    echo " ";
    echo $email = $_POST['email'];
    echo " ";
    echo $companyDesc = $_POST['description'];
    echo " ";
    echo $companyID = $_POST['companyID'];
    

    $dbCon = dbCon();
    $query = $dbCon->prepare("UPDATE company SET `name`= '$name', `address`= '$address', `postalID`= '$postal', `phone`= '$phone' , `email`= '$email' , `description`= '$companyDesc' WHERE companyID = $companyID");
    $query->execute();
     header("Location: aboutUs.php?status=updated&ID=$companyID");

}else{
    header("Location: aboutUs.php?status=0");
}