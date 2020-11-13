<?php
function dbCon(){
try {
    $userReal = "jonaskp_dk";
    $passReal = "B4tt3ryH0rs3";
   
    $dbCon = new PDO('mysql:host=mysql37.unoeuro.com;dbname=jonaskp_dk_db;charset=utf8', $userReal, $passReal);
    $dbCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$dbCon = null;
    return $dbCon;
} catch (PDOException $err) {
    echo "Error!: " . $err->getMessage() . "<br/>";
    die();
}}
