<?php

class DailySpecialDAO
{
    /*  public function readDailySpecialDB()
    {
        try {
            $dbcon = dbCon();

            $query = $dbcon->prepare('SELECT * FROM dailySpecial');
            $query->execute();
            $result = $query->fetchAll(\PDO::FETCH_OBJ);

            return $result;

        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    } */


    public function readDailySpecialByIdDB($dailyID)
    {
        $dbcon = dbCon();

        $query = "SELECT * FROM DailySpecial WHERE dailyID= :dailyID";
        $handle = $dbcon->prepare($query);
        $handle->bindParam(':dailyID', $dailyID);

        $handle->execute();
        $result = $handle->fetchAll();

        return $result;
    }

    public function createDailySpecialDB($discount)
    {
        try {
            $dbcon = dbCon();

            $query = "INSERT INTO DailySpecial (discount) VALUES (:discount)";
            $handle = $dbcon->prepare($query);

            $sanitized_discount = htmlspecialchars(trim($discount));


            $handle->bindParam(':discount', $sanitized_discount);


            $handle->execute();

            $last_id = $dbcon->lastInsertId();

            $dbcon = null;

            return $last_id;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function deleteDailySpecialDB($dailyID)
    {
        try {
            $dbcon = dbCon();

            $query = "DELETE FROM DailySpecial WHERE dailyID = :dailyID";
            $handle = $dbcon->prepare($query);
            $handle->bindParam(':dailyID', $dailyID);

            $handle->execute();

            //close the connection
            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

}
