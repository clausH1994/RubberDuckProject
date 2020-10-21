<?php
require_once "dbcon.php";
if (isset($_POST['submit'])) {

$userName = $_POST['Name'];
$firstName = $_POST['Category'];
$lastName = $_POST['Price'];
$email = $_POST['Image'];
$description = $_POST['description'];

$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("INSERT INTO customers (`name`, `category`, `price`, `Image`, `description`) VALUES ('$Name', '$Category', '$Price', '$Image', '$description')");
$query->execute();
    header("Location: index.php?status=added");

}else{
    header("Location: index.php?status=0");
}
