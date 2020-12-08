<?php
require_once "../connection/dbcon.php";
require_once "../connection/session.php";

$session = new Session();

if (isset($_POST['openinghoursID']) && isset($_POST['submit'])) {
    if (!empty($_POST['token'])) {
        if (hash_equals($_SESSION['token'], $_POST['token'])) {
            unset($_SESSION['token']);
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
                $sanitized_id = htmlspecialchars(trim($openinghoursID));

                $handle->bindParam(':weekday', $sanitized_weekday);
                $handle->bindParam(':startTime', $sanitized_startTime);
                $handle->bindParam(':endtime', $sanitized_endtime);
                $handle->bindParam(':openinghoursID', $sanitized_id);

                $handle->execute();
            } catch (\PDOException $ex) {
                print($ex->getMessage());
            }
            header("Location: openingHours.php?status=updated&ID=$openinghoursID");
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
} else {
    header("Location: openingHours.php?status=0");
}
