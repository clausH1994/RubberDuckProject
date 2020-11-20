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
}