<?php
require_once "../connection/dbcon.php";

$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM company");
$query->execute();
$getData = $query->fetchAll();


foreach ($getData as $getData) {
echo $getData['name'];
echo " ";
echo $getData['address'];
echo " ";
echo $getData['postalID'];
echo " ";
echo $getData['phone'];
echo " ";
echo $getData['email'];
echo " ";
echo $getData['description'];
}