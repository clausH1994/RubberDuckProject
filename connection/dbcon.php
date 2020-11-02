<?php
function dbCon(){
try {
    $userReal = "Admin";
    $passReal = "123456";
   
    $dbCon = new PDO('mysql:host=localhost;dbname=rubberduckdb;charset=utf8', $userReal, $passReal);
    $dbCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$dbCon = null;
    return $dbCon;
} catch (PDOException $err) {
    echo "Error!: " . $err->getMessage() . "<br/>";
    die();
}}
