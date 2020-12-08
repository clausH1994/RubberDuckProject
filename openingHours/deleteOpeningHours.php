<?php
require_once "../connection/dbcon.php";
require_once "../connection/session.php";

$session = new Session();

if (isset($_GET['ID'])) {
    if (!empty($_GET['token'])) {
        if (hash_equals($_SESSION['token'], $_GET['token'])) {
            unset($_SESSION['token']);
            $openinghoursID = $_GET['ID'];

            try {
                $dbCon = dbCon();
                $query = ("DELETE FROM OpeningHours WHERE openinghoursID=:openinghoursID");
                $handle = $dbCon->prepare($query);

                $sanitized_ID = htmlspecialchars(trim($openinghoursID));
                $handle->bindParam(':openinghoursID', $sanitized_ID);

                $handle->execute();
            } catch (\PDOException $ex) {
                print($ex->getMessage());
            }
            header("Location: openingHours.php?status=deleted&ID=$openinghoursID");
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
} else {
    header("Location: openingHours.php?status=0");
}
