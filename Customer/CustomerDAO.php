<?php
require_once("../connection/dbcon.php");


class CustomerDAO
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

    public function readCustomerByIdDB($customerId)
    {
        $dbcon = dbCon();

        $query = "SELECT * FROM Customer c, PostalCode p WHERE c.customerID= :customerID 
        AND c.postalID = p.zipcodeID";
        $handle = $dbcon->prepare($query);

        $sanitized_id = htmlspecialchars(trim($customerId));
        $handle->bindParam(':customerID', $sanitized_id);
        $handle->execute();

        $result = $handle->fetchAll();

        return $result;
    }

    public function updateCustomerDB($fname, $lname, $pass, $phone, $email, $address, $postal, $customerID)
    {
        try {
            $dbcon = dbCon();

            $query = "UPDATE Customer SET fname = :fName, lname = :lName, pass = :pass, 
            phonenumber = :phone, email = :email, address = :address, postalID = :postal 
            WHERE customerID = :customerID";
            $handle = $dbcon->prepare($query);

            $sanitized_fname = htmlspecialchars(trim($fname));
            $sanitized_lname = htmlspecialchars(trim($lname));
            $sanitized_pass = htmlspecialchars(trim($pass));
            $sanitized_phone = htmlspecialchars(trim($phone));
            $sanitized_email = htmlspecialchars(trim($email));
            $sanitized_address = htmlspecialchars(trim($address));
            $sanitized_postal = htmlspecialchars(trim($postal));

            $sanitized_id = htmlspecialchars(trim($customerID));

            $handle->bindParam(':customerID', $sanitized_id);

            $handle->bindParam(':fName', $sanitized_fname);
            $handle->bindParam(':lName', $sanitized_lname);
            $handle->bindParam(':pass', $sanitized_pass);
            $handle->bindParam(':phone', $sanitized_phone);
            $handle->bindParam(':email', $sanitized_email);
            $handle->bindParam(':address', $sanitized_address);
            $handle->bindParam(':postal', $sanitized_postal);

            $handle->execute();

            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }
}
