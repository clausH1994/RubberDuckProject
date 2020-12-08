<?php
require_once("../connection/dbcon.php");
require_once "../connection/session.php";

$session = new Session();

if (isset($_POST["submit"])) {
    if (!empty($_POST['token'])) {
        if (hash_equals($_SESSION['token'], $_POST['token'])) {
            unset($_SESSION['token']);

            $weekday = $_POST["day"];
            $startTime = $_POST["startTime"];
            $endtime = $_POST["endtime"];

            try {
                $dbCon = dbCon();

                $query = "INSERT INTO `OpeningHours` (day, startTime, endtime) 
            VALUES (:day, :startTime , :endtime)";
                $handle = $dbCon->prepare($query);

                $sanitized_weekday = htmlspecialchars(trim($weekday));
                $sanitized_startTime = htmlspecialchars(trim($startTime));
                $sanitized_endtime = htmlspecialchars(trim($endtime));


                $handle->bindParam(':day', $sanitized_weekday);
                $handle->bindParam(':startTime', $sanitized_startTime);
                $handle->bindParam(':endtime', $sanitized_endtime);

                $handle->execute();
                $dbcon = null;
            } catch (\PDOException $ex) {
                print($ex->getMessage());
            }

            header("Location: openingHours.php?status=added");
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
} else {
    header("Location: aboutUs.php?status=0");
};
