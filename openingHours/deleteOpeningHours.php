<?php
require_once "../connection/dbcon.php";
if (isset($_GET['ID'])) {
    $openinghoursID = $_GET['ID'];

try{
    $dbCon = dbCon();
    $query = ("DELETE FROM OpeningHours WHERE openinghoursID=:openinghoursID");
    $handle = $dbCon->prepare($query);
    $handle->bindParam(':openinghoursID', $openinghoursID);
    
    $handle->execute();

}catch (\PDOException $ex) {
    print($ex->getMessage());
}
    header("Location: openingHours.php?status=deleted&ID=$openinghoursID");
}else{
    header("Location: openingHours.php?status=0");
}