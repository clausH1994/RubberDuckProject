<?php
require_once("../connection/dbcon.php");

class OfferDAO
{
    public function createOfferDB($productID, $dailyID)
    {
        try {
            $dbcon = dbCon();

            $query = "INSERT INTO Offer (productID, dailyID) VALUES (:productID, :dailyID)";
            $handle = $dbcon->prepare($query);

            $handle->bindParam(':productID', $productID);
            $handle->bindParam(':dailyID', $dailyID);

            $handle->execute();

            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function deleteOfferDB($offerID)
    {
        try {
            $dbcon = dbCon();

            $query = "DELETE FROM Offer WHERE offer = :offerID";
            $handle = $dbcon->prepare($query);
            $handle->bindParam(':offerID', $offerID);

            $handle->execute();

            //close the connection
            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }
}
