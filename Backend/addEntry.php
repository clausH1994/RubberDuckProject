<?php
require_once "../connection/dbcon.php";
if (isset($_POST['submit'])) {

$Name = $_POST['Name'];
$Color = $_POST['Color'];
$Price = $_POST['Price'];
$Image = $_POST['Image'];
$description = $_POST['description'];

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("INSERT INTO product (`name`, `color`, `price`, `image`, `description`) VALUES ('$Name', '$Color', '$Price', '$Image', '$description')");
$query->execute();
    header("Location: index.php?status=added");

}else{
    header("Location: index.php?status=0");
}
