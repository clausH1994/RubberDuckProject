<?php
require_once("../connection/dbcon.php");

class NewsDAO
{
    public function readNewsDB()
    {
        try {
            $dbcon = dbCon();

            $query = $dbcon->prepare('SELECT * FROM News');
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

        $query = "SELECT * FROM News WHERE newsID= :newsID";
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

            $query = "INSERT INTO News (title, `description`, `date`) VALUES (:title, :description, :date)";
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

            $query = "UPDATE News SET title = :title, `description` = :description, `date` = :date WHERE newsID = :newsID";
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

            $query = "DELETE FROM News WHERE newsID = :newsID";
            $handle = $dbcon->prepare($query);
            $handle->bindParam(':newsID', $newsID);

            $handle->execute();

            //close the connection
            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function NewsAndSpecialDataDB()
    {
        $dbcon = dbCon();
        $query = ('SELECT * FROM NewsAndSpecialData WHERE newsID = :newsID');

        $handle = $dbcon->prepare($query);
        $handle->bindParam(':newsID', $_GET['ID']);
        $handle->execute();

        $result = $handle->fetchAll();

        return $result;
    }

    public function deleteNewsAndrelevantRelationsDB($newsID)
    {
        require_once("../SpecialNews/SpecialNewsController.php");
        require_once("../dailySpecial/DailySpecialController.php");
        require_once("../offer/OfferController.php");
        $SpecialNewsCon = new SpecialNewsController();
        $dailySpecailCon = new DailySpecialController();
        $offerCon = new OfferController();

        try {
            $dbcon = dbCon();
            $query = "SELECT n.newsID, ds.dailyID, o.offer 
            FROM News n, SpecialNews sn, DailySpecial ds, Offer o
            WHERE n.newsID = sn.news
            AND sn.daily = ds.dailyID
            AND o.dailyID = ds.dailyID
            AND n.newsID = :newsID";

            $handle = $dbcon->prepare($query);
            $handle->bindParam(':newsID', $newsID);
            $handle->execute();


            $result = $handle->fetchAll();
            echo var_dump($result);

            foreach($result as $res)
            {

            }

            // $query2 = "DELETE FROM News WHERE newsID = :newsID";
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }
}
