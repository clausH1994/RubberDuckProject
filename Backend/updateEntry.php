<?php
require_once "dbcon.php";
if (isset($_POST['entryID']) && isset($_POST['submit'])) {
    $Name = $_POST['Name'];
    $Category = $_POST['Category'];
    $Color = $_POST['Color'];
    $Price = $_POST['Price'];
    $description = $_POST['description'];


    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("UPDATE customers SET `Name`='$Name', `Fname`='$Category', `Lname`='$Color', `Price`='$Price', `description`='$description' WHERE ID=$ProductID");
    $query->execute();
    header("Location: index.php?status=updated&ID=$ProductID");

}else{
    header("Location: index.php?status=0");
}