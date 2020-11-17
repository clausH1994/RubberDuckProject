<?php 
require_once("../connection/dbcon.php");


Class CustomerDAO
{
    public function createCustomerDB($fname, $lname, $phone, $address, $zipcode, $email, $pass)
    {
        try {
            $dbcon = dbCon();

            $query = $query = "INSERT INTO Customer (fname, lname, pass, phonenumber, email, address, postalID) 
            VALUES (:fName, :lName, :Pass, :phone, :Email, :address, :zipcode)";
            $handle = $dbcon->prepare($query);


            $sanitized_fname = htmlspecialchars(trim($fname));
            $sanitized_lname = htmlspecialchars(trim($lname));
            $sanitized_phone = htmlspecialchars(trim($phone));
            $sanitized_address = htmlspecialchars(trim($address));
            $sanitized_zipcode = htmlspecialchars(trim($zipcode));
            $sanitized_email = htmlspecialchars(trim($email));
            $sanitized_pass = htmlspecialchars(trim($pass));

            $handle->bindParam(':fName', $sanitized_fname);
            $handle->bindParam(':lName', $sanitized_lname);
            $handle->bindParam(':phone', $sanitized_phone);
            $handle->bindParam(':address', $sanitized_address);
            $handle->bindParam(':zipcode', $sanitized_zipcode);
            $handle->bindParam(':Email', $sanitized_email);
            $handle->bindParam(':Pass', $sanitized_pass);

            $handle->execute();

            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }
}