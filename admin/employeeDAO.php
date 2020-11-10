<?php
require_once("../connection/dbcon.php");

class EmployeeDAO
{

    public function readEmployeeByIdDB($emID)
    {
        $dbcon = dbCon();

        $query = "SELECT * FROM employee WHERE employeeID= :employeeID";
        $handle = $dbcon->prepare($query);
        $handle->bindParam(':employeeID', $emID);
        $handle->execute();

        $result = $handle->fetchAll();

        return $result;
    }

    public function readEmployeeDB()
    {
        try {

            $dbcon = dbCon();

            $query = $dbcon->prepare('SELECT * FROM employee');
            $query->execute();
            $result = $query->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function CreateEmployeeDB($fname, $lname, $email, $pass)
    {
        try {
            $dbcon = dbCon();

            $query = "INSERT INTO employee (fname, lname, email, pass) VALUES (:fName, :lName, :Email, :Pass)";
            $handle = $dbcon->prepare($query);

            $sanitized_fname = htmlspecialchars(trim($fname));
            $sanitized_lname = htmlspecialchars(trim($lname));
            $sanitized_email = htmlspecialchars(trim($email));
            $sanitized_pass = htmlspecialchars(trim($pass));

            $handle->bindParam(':fName', $sanitized_fname);
            $handle->bindParam(':lName', $sanitized_lname);
            $handle->bindParam(':Email', $sanitized_email);
            $handle->bindParam(':Pass', $sanitized_pass);
     

            $handle->execute();

            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function UpdateEmployeeDB($emID, $fname, $lname, $email, $pass)
    {
        try {


            $dbcon = dbCon();

            $query = "UPDATE employee SET fname = :fName, lname = :lName, email = :Email, pass = :Pass WHERE employeeID = :EmployeeID";
            $handle = $dbcon->prepare($query);

            $sanitized_fname = htmlspecialchars(trim($fname));
            $sanitized_lname = htmlspecialchars(trim($lname));
            $sanitized_email = htmlspecialchars(trim($email));
            $sanitized_pass = htmlspecialchars(trim($pass));

            $handle->bindParam(':fName', $sanitized_fname);
            $handle->bindParam(':lName', $sanitized_lname);
            $handle->bindParam(':Email', $sanitized_email);
            $handle->bindParam(':Pass', $sanitized_pass);
            $handle->bindParam(':EmployeeID', $emID);

            $handle->execute();

            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function deleteEmployeeDB($emID)
    {
        try {
            $dbcon = dbCon();

            $query = "DELETE FROM employee WHERE employeeID = :employeeID";
            $handle = $dbcon->prepare($query);
            $handle->bindParam(':employeeID', $emID);

            $handle->execute();

            //close the connection
            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }
}
