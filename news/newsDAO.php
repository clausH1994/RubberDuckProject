<?php
require_once("../connection/dbcon.php");

class NewsDAO
{

    public function readNewsDB()
    {
        try {

            $dbcon = dbCon();

            $query = $dbcon->prepare('SELECT * FROM news');
            $query->execute();
            $result = $query->fetchAll(\PDO::FETCH_OBJ);
            return $result;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }


    public function readNewsByIdDB($newsID)
    {
        $dbcon = dbCon();

        $query = "SELECT * FROM news WHERE newsID= :newsID";
        $handle = $dbcon->prepare($query);
        $handle->bindParam(':newsID', $newsID);

        $handle->execute();
        $result = $handle->fetchAll();

        return $result;
    }


    public function createNewsDB($title, $description, $date)
    {
        try {
            $dbcon = dbCon();

            $query = "INSERT INTO news (title, `description`, `date`) VALUES (:title, :description, :date)";
            $handle = $dbcon->prepare($query);

            $sanitized_title = htmlspecialchars(trim($title));
            $sanitized_description = htmlspecialchars(trim($description));
            $sanitized_date = htmlspecialchars(trim($date));

            $handle->bindParam(':title', $sanitized_title);
            $handle->bindParam(':description', $sanitized_description);
            $handle->bindParam(':date', $sanitized_date);

            $handle->execute();

            $last_id = $dbcon->lastInsertId();
          
            $dbcon = null;
            return $last_id;

        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function updateNewsDB($newsID, $title, $description, $date)
    {
        try {
            $dbcon = dbCon();

            $query = "UPDATE news SET title = :title, `description` = :description, `date` = :date WHERE newsID = :newsID";
            $handle = $dbcon->prepare($query);

            $sanitized_title = htmlspecialchars(trim($title));
            $sanitized_description = htmlspecialchars(trim($description));
            $sanitized_date = htmlspecialchars(trim($date));

            $handle->bindParam(':title', $sanitized_title);
            $handle->bindParam(':description', $sanitized_description);
            $handle->bindParam(':date', $sanitized_date);
            $handle->bindParam(':newsID', $newsID);

            $handle->execute();

            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function deleteNewsDB($newsID)
    {
        try {
            $dbcon = dbCon();

            $query = "DELETE FROM news WHERE newsID = :newsID";
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
