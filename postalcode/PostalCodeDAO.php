<?php 

class PostalCodeDAO
{
    public function createPostalCodeDB($zipCode, $city)
    {
        try {
            $dbcon = dbCon();

            $query = "INSERT INTO PostalCode (zipcodeID, City) VALUES (:zipcode, :city)";
            $handle = $dbcon->prepare($query);

            $sanitized_zipcode = htmlspecialchars(trim($zipCode));
            $sanitized_city = htmlspecialchars(trim($city));

            $handle->bindParam(':zipcode', $sanitized_zipcode);
            $handle->bindParam(':city', $sanitized_city);

            $handle->execute();

            $dbcon = null;
        } catch (\PDOException $ex) {
            print($ex->getMessage());
        }
    }

    public function readPostalCodeByID($postalID)
    {
        $dbcon = dbCon();

        $query = $dbcon->prepare("SELECT * FROM PostalCode WHERE zipcodeID=$postalID");
        $query->execute();
        $result = $query->fetchAll();
      
        return $result;
    }

}