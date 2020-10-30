<?php

require ("aboutUs.php");

if(isset($_POST["submit"])){
    $name= $_POST["name"];
    $address= $_POST["address"];
    $postal= $_POST["postalID"];
    $phone= $_POST["phone"];      
    $email= $_POST["email"];
    $companyDesc= $_POST["description"];

    $dbCon = dbCon($user, $pass);

    $query =$dbCon->prepare ("INSERT INTO `company` (`name`, `address`, `postalID`, `phone`,`email`, `description`) 
            VALUES ('$name','$address','$postal' ,'$phone','$email', '$companyDesc')");
    $query->execute();
    //header("Location: aboutUs.php?status=added");

}else{
   // header("Location: aboutUs.php?status=0");
}
