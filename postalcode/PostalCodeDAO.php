<?php 

class PostalCodeDAO
{
    public function createPostalCodeDB($zipCode, $city)
    {
        try {
            $dbcon = dbCon();

            $query = "INSERT INTO postalcode (zipcodeID, City) VALUES ('" . $zipCode . "', '" . $city . "')";
            $handle = $dbcon->prepare($query);
            $handle->execute();

            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function readPostalCodeByID($postalID)
    {
        $dbcon = dbCon();

        $query = $dbcon->prepare("SELECT * FROM postalcode WHERE zipcodeID=$postalID");
        $query->execute();
        $result = $query->fetchAll();
      
        return $result;
    }

}