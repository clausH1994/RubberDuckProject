<?php
require_once "dbcon.php";
if (isset($_POST['entryID']) && isset($_POST['submit'])) {
    $entryID = $_POST['entryID'];
    $Name = $_POST['Name'];
    $Color = $_POST['Color'];
    $Price = $_POST['Price'];
    $description = $_POST['description'];


    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("UPDATE product SET `name`='$Name', `color`='$Color', `price`='$Price', `description`='$description' WHERE productID=$entryID");
    $query->execute();
    header("Location: index.php?status=updated&ID=$ProductID");

}else{
    header("Location: index.php?status=0");
}