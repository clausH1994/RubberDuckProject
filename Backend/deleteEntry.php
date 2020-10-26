<?php
require_once "dbcon.php";
if (isset($_GET['ID'])) {
    $entryID = $_GET['ID'];
    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("DELETE FROM Product WHERE id=$ProductID");
    $query->execute();

    header("Location: index.php?status=deleted&ID=$ProductID");
}else{
    header("Location: index.php?status=0");
}