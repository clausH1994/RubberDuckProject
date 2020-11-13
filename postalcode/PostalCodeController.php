<?php
require_once("PostalCodeDAO.php");

class PostalCodeController
{
    public function CheckPostalCode($zipcode, $city)
    {
        $postalDAO = new PostalCodeDAO;
        $result = $postalDAO->readPostalCodeByID($zipcode);

        if ($result == null) {
            $postalDAO->createPostalCodeDB($zipcode, $city);
        }
    }
}
