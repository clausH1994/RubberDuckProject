<?php
require_once "../connection/dbcon.php";
if (isset($_GET['ID'])) {
    $companyID = $_GET['ID'];

try{
    $dbCon = dbCon();
    $query = ("DELETE FROM Company WHERE companyID=:companyID");
    $handle = $dbCon->prepare($query);
    $handle->bindParam(':companyID', $companyID);
    
    $handle->execute();

}catch (\PDOException $ex) {
    print($ex->getMessage());
}
    header("Location: aboutUs.php?status=deleted&ID=$companyID");
}else{
    header("Location: aboutUs.php?status=0");
}