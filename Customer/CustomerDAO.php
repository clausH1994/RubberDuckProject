<?php 
require_once("../connection/dbcon.php");


Class CustomerDAO
{
    public function createCustomerDB($fname, $lname, $phone, $address, $zipcode, $email, $pass)
    {
        try {
            $dbcon = dbCon();

            $query = "INSERT INTO customer (fname, lname, pass, phonenumber, email, `address`, postalID) 
            VALUES ('" . $fname . "','" . $lname . "', '" . $pass . "', '" . $phone . "', '" . $email . "', '" . $address . "', '" . $zipcode . "')";
            $handle = $dbcon->prepare($query);
            $handle->execute();

            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }
}