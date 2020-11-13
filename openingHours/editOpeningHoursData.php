<?php
require_once "../connection/dbcon.php";
if (isset($_POST['openinghoursID']) && isset($_POST['submit'])) {
    $weekday = $_POST['day'];
    $startTime = $_POST['startTime'];
    $endtime = $_POST['endtime'];
    $openinghoursID = $_POST['openinghoursID'];

    try {

    $dbCon = dbCon();
    $query = ("UPDATE OpeningHours SET `day`= :weekday, `startTime`= :startTime, `endtime`= :endtime WHERE openinghoursID = :openinghoursID");
    $handle = $dbCon->prepare($query);
    
    $sanitized_weekday = htmlspecialchars(trim($weekday));
    $sanitized_startTime = htmlspecialchars(trim($startTime));
    $sanitized_endtime = htmlspecialchars(trim($endtime));

    
    $handle->bindParam(':weekday', $sanitized_weekday);
    $handle->bindParam(':startTime', $sanitized_startTime);
    $handle->bindParam(':endtime', $sanitized_endtime);
    $handle->bindParam(':openinghoursID', $openinghoursID);

    $handle->execute();
 

    }catch (\PDOException $ex) {
        print($ex->getMessage());
    }
    header("Location: openingHours.php?status=updated&ID=$openinghoursID");
}else{
    header("Location: openingHours.php?status=0");
}