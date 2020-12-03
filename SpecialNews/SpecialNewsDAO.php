<?php

class SpecialNewsDAO
{
    public function readSpecialNewsDB()
    {
        try {

            $dbcon = dbCon();

            $query = $dbcon->prepare('SELECT * FROM SpecialNews');
            $query->execute();
            $result = $query->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function readSpecialNewsByNewsDB($newsID)
    {
        $dbcon = dbCon();

        $query = "SELECT * FROM SpecialNews WHERE news= :newsID";
        $handle = $dbcon->prepare($query);
        $handle->bindParam(':newsID', $newsID);

        $handle->execute();
        $result = $handle->fetchAll();

        return $result;
    }


    public function createSpecialNewsDB($dailyID, $newsID)
    {
        try {
            $dbcon = dbCon();

            $query = "INSERT INTO SpecialNews (daily, news) VALUES (:dailyID ,:newsID)";
            $handle = $dbcon->prepare($query);

            $sanitized_title = htmlspecialchars(trim($dailyID));
            $sanitized_description = htmlspecialchars(trim($newsID));

            $handle->bindParam(':dailyID', $sanitized_title);
            $handle->bindParam(':newsID', $sanitized_description);

            $handle->execute();

            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function deleteSpecialNewsWithNewsIDDB($newsID)
    {
        try {
            $dbcon = dbCon();

            $query = "DELETE FROM SpecialNews WHERE news = :newsID";
            $handle = $dbcon->prepare($query);
            $handle->bindParam(':newsID', $newsID);

            $handle->execute();

            //close the connection
            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }
}
