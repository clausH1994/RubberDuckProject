<?php
require_once("employeeController.php");


if (isset($_GET['ID'])) {
    $emID = $_GET['ID'];
    $employeeCon = new employeeController();
    $employeeCon->deleteEmployee($emID);
}