<?php

require_once("../connection/dbcon.php");

if(isset($_POST["submit"])){
    $name= $_POST["name"];
    $address= $_POST["address"];
    $postal= $_POST["postalID"];
    $phone= $_POST["phone"];      
    $email= $_POST["email"];
    $companyDesc= $_POST["description"];

    try{    
    $dbCon = dbCon();

    $query = "INSERT INTO `company` (`name`, `address`, postalID, phone, email, `description`) 
            VALUES (:name, :address , :postalID ,:phone,:email, :companyDesc)";
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

    $handle->execute();
    $dbcon = null;
}catch (\PDOException $ex) {
    print($ex->getMessage());
}
    header("Location: aboutUs.php?status=added");

}else{
    header("Location: aboutUs.php?status=0");
};



