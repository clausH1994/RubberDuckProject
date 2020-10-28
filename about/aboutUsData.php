<?php

require ("aboutUs.php");
require ("../connection/conn.php");
if(isset($_POST["submit"])){
    $name= $_POST["name"];

    $address= $_POST["address"];

    $postal= $_POST["postalId"];

    $phone= $_POST["phone"];
      
    $email= $_POST["email"];
    
    $companyDesc= $_POST["description"];

    mysqli_set_charset($connection, "utf8");

$query = "INSERT INTO `company` (`name`, `address`, `postalId`, `phone`,`email`, `description`) 
            VALUES ('$name','$address','$postal' ,'$phone','$email', '$companyDesc')";

            

if(!mysqli_query($connection, $query)){
    die("error". mysqli_error($connection));
}

}