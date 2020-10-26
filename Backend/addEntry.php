<?php
require_once "dbcon.php";
if (isset($_POST['submit'])) {

$Name = $_POST['Name'];
$Category = $_POST['Category'];
$Color = $_POST['Color'];
$Price = $_POST['Price'];
$image = $_POST['Image'];
$description = $_POST['description'];

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("INSERT INTO customers (`name`, `category`, `Color`, `Price`, `Image`, `description`) VALUES ('$Name', '$Category', '$Color', '$Price', '$Image', '$description')");
$query->execute();
    header("Location: index.php?status=added");

}else{
    header("Location: index.php?status=0");
}
