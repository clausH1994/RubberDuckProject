<?php
require_once("../connection/dbcon.php");

class OfferDAO
{
    public function CreateOfferDB($productID, $dailyID)
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
}