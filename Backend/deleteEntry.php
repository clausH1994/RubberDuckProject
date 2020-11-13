<?php
require_once "../connection/dbcon.php";
if (isset($_GET['ID'])) {
    $entryID = $_GET['ID'];
    $dbCon = dbCon();
    $query = $dbCon->prepare("DELETE FROM Product WHERE productID=$entryID");
    $query->execute();

    header("Location: index.php?status=deleted&ID=$entryID");
}else{
    header("Location: index.php?status=0");
}