<?php
require_once "../connection/dbcon.php";
require_once "../connection/functions.php";
if (isset($_POST['submit'])) {

    
$Name = $_POST['Name'];
$Color = $_POST['Color'];
$Price = $_POST['Price'];
$Image = $_POST['Image'];
$description = $_POST['description'];

//$sql = "INSERT INTO product (`name`, `color`, `price`, `image`, `description`) VALUES (:name, :color, :Price, :Image, '$description')";
//$query = $dbCon->prepare($sql);
$query = dbCon()->prepare("INSERT INTO product (`name`, `color`, `price`, `image`, `description`) VALUES ('$Name', '$Color', '$Price', '$Image', '$description')");

//$handle->bindParam(':name', htmlspecialchars(trim($Name)));
		


$query->execute();
    header("Location: index.php?status=added");

}

else{
    header("Location: index.php?status=0");
}
