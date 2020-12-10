<?php
require_once "../connection/dbcon.php";
require_once "../connection/session.php";

$session = new Session();

if (isset($_GET['ID'])) {
    if (!empty($_GET['token'])) {
        if (hash_equals($_SESSION['token'], $_GET['token'])) {
            unset($_SESSION['token']);
            $companyID = $_GET['ID'];

            try {
                $dbCon = dbCon();
                $query = ("DELETE FROM Company WHERE companyID=:companyID");
                $handle = $dbCon->prepare($query);
                $sanitized_ID = htmlspecialchars(trim($companyID));
                $handle->bindParam(':companyID', $sanitized_ID);

                $handle->execute();
            } catch (\PDOException $ex) {
                print($ex->getMessage());
            }
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
    header("Location: aboutUs.php?status=deleted&ID=$companyID");
} else {
    header("Location: aboutUs.php?status=0");
}
