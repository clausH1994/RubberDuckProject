<?php
require_once("../connection/dbcon.php");

if(isset($_POST["submit"])){
    $weekday= $_POST["day"];
    $startTime= $_POST["startTime"];
    $endTime= $_POST["endTIme"];

    try{    
    $dbCon = dbCon();

    $query = "INSERT INTO `openinghours` (day, startTime, endTime) 
            VALUES (:day, :startTime , :endTime)";
           $handle = $dbCon->prepare($query);
    
    $sanitized_weekday = htmlspecialchars(trim($weekday));
    $sanitized_startTime = htmlspecialchars(trim($startTime));
    $sanitized_endTime = htmlspecialchars(trim($endTime));

    
    $handle->bindParam(':day', $sanitized_weekday);
    $handle->bindParam(':startTime', $sanitized_startTime);
    $handle->bindParam(':endTime', $sanitized_endTime);

    $handle->execute();
    $dbcon = null;
}catch (\PDOException $ex) {
    print($ex->getMessage());
}
    header("Location: openingHours.php?status=added");

}else{
    header("Location: aboutUs.php?status=0");
};