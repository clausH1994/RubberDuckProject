<?php
require_once "../connection/dbcon.php";
require_once "../connection/session.php";

$session = new Session();

if (isset($_GET['ID'])) {
    if (!empty($_GET['token'])) {
        if (hash_equals($_SESSION['token'], $_GET['token'])) {
            unset($_SESSION['token']);

            $entryID = $_GET['ID'];

            $dbCon = dbCon();
            $query = $dbCon->prepare("DELETE FROM ProductCategory WHERE product=$entryID");

            $query->execute();

            $query = $dbCon->prepare("DELETE FROM Product WHERE ID=:ID");

            $sanitized_id = htmlspecialchars(trim($entryID));
            $query->bindParam(':ID', $sanitized_id);

            $query->execute();

            header("Location: index.php?status=deleted&ID=$entryID");
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
} else {
    header("Location: index.php?status=0");
}
