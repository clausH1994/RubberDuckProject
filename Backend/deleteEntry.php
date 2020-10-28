<?php
require_once "../connection/dbcon.php";
if (isset($_GET['ID'])) {
    $entryID = $_GET['ID'];
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("DELETE FROM product WHERE productID=$entryID");
    $query->execute();

    header("Location: index.php?status=deleted&ID=$entryID");
}else{
    header("Location: index.php?status=0");
}