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

            $sanitized_productID = htmlspecialchars(trim($productID));
            $sanitized_dailyID = htmlspecialchars(trim($dailyID));

            $handle->bindParam(':productID', $sanitized_productID);
            $handle->bindParam(':dailyID', $sanitized_dailyID);

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

            $sanitized_ID = htmlspecialchars(trim($offerID));
            $handle->bindParam(':offerID', $sanitized_ID);

            $handle->execute();

            //close the connection
            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }
}
