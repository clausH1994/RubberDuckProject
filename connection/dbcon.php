<?php
$user = "Admin";
$pass = "123456";
function dbCon($user, $pass){
try {
    $dbCon = new PDO('mysql:host=localhost;dbname=rubberduckdb;charset=utf8', $user, $pass);
    //$dbCon = null;
    return $dbCon;
} catch (PDOException $err) {
    echo "Error!: " . $err->getMessage() . "<br/>";
    die();
}}
