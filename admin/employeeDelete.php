<?php
require_once("employeeController.php");
require_once("../connection/session.php");

$session = new Session();

if (isset($_GET['ID'])) {
    if (!empty($_GET['token'])) {
        if (hash_equals($_SESSION['token'], $_GET['token'])) {
            unset($_SESSION['token']);
            $emID = $_GET['ID'];
            $employeeCon = new employeeController();
            $employeeCon->deleteEmployee($emID);
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
}
