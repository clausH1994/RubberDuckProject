<?php
require_once "../connection/dbcon.php";
if (isset($_POST['companyID']) && isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $postal = $_POST['postalID'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $companyDesc = $_POST['description'];
    $companyID = $_POST['companyID'];

    

    try {

    $dbCon = dbCon();
    $query = ("UPDATE Company SET `name`= :name, `address`= :address, `postalID`= :postalID, `phone`= :phone , `email`= :email , `description`= :companyDesc WHERE companyID = :companyID");
    $handle = $dbCon->prepare($query);
    
    $sanitized_name = htmlspecialchars(trim($name));
    $sanitized_address = htmlspecialchars(trim($address));
    $sanitized_postal = htmlspecialchars(trim($postal));
    $sanitized_phone = htmlspecialchars(trim($phone));
    $sanitized_email = htmlspecialchars(trim($email));
    $sanitized_companyDesc = htmlspecialchars(trim($companyDesc));
    
    $handle->bindParam(':name', $sanitized_name);
    $handle->bindParam(':address', $sanitized_address);
    $handle->bindParam(':postalID', $sanitized_postal);
    $handle->bindParam(':phone', $sanitized_phone);
    $handle->bindParam(':email', $sanitized_email);
    $handle->bindParam(':companyDesc', $sanitized_companyDesc);
    $handle->bindParam(':companyID', $companyID);

    $handle->execute();
 

    }catch (\PDOException $ex) {
        print($ex->getMessage());
    }
    header("Location: aboutUs.php?status=updated&ID=$companyID");
}else{
    header("Location: aboutUs.php?status=0");
}