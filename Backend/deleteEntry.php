<?php
require_once "../connection/dbcon.php";
if (isset($_GET['ID'])) {
    $entryID = $_GET['ID'];
    $dbCon = dbCon();

    $delete = $dbCon->prepare("DELETE FROM ProductCategory WHERE product=$entryID");

    $delete->execute();

    $query = $dbCon->prepare("DELETE FROM Product WHERE ID=$entryID");
    $query->execute();

    header("Location: index.php?status=deleted&ID=$entryID");
}else{
    header("Location: index.php?status=0");
}