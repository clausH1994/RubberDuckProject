<?php
require_once("../connection/dbcon.php");

class employeeDAO
{

    public function readEmployeeByIdDB($emID)
    {
        $dbcon = dbCon();

        $query = "SELECT * FROM Employee WHERE employeeID= :employeeID";
        $handle = $dbcon->prepare($query);
        $sanitized_ID = htmlspecialchars(trim($emID));
        $handle->bindParam(':employeeID', $sanitized_ID);
        $handle->execute();

        $result = $handle->fetchAll();

        return $result;
    }

    public function readEmployeeDB()
    {
        try {

            $dbcon = dbCon();

            $query = $dbcon->prepare('SELECT * FROM Employee');
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

            $query = "INSERT INTO Employee (fname, lname, email, pass) VALUES (:fName, :lName, :Email, :Pass)";
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

            $query = "UPDATE Employee SET fname = :fName, lname = :lName, email = :Email, pass = :Pass WHERE employeeID = :employeeID";
            $handle = $dbcon->prepare($query);

            $sanitized_fname = htmlspecialchars(trim($fname));
            $sanitized_lname = htmlspecialchars(trim($lname));
            $sanitized_email = htmlspecialchars(trim($email));
            $sanitized_pass = htmlspecialchars(trim($pass));

            $sanitized_ID = htmlspecialchars(trim($emID));
            $handle->bindParam(':employeeID', $sanitized_ID);

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

    public function deleteEmployeeDB($emID)
    {
        try {
            $dbcon = dbCon();

            $query = "DELETE FROM Employee WHERE employeeID = :employeeID";
            $handle = $dbcon->prepare($query);
            $sanitized_ID = htmlspecialchars(trim($emID));
            $handle->bindParam(':employeeID', $sanitized_ID);

            $handle->execute();

            //close the connection
            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }
}
?>
