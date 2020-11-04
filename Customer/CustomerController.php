<?php 
require_once("CustomerDAO.php");
require_once("../postalcode/POstalCodeController.php");

class CustomerController
{


    public function registerCustomer($fname, $lname, $phone, $address, $zipcode, $city, $email, $pass)
    {
        $postalCon = new PostalCodeController();
        $postalCon->CheckPostalCode($zipcode, $city);

        $email = trim($email);
		$pass = trim($pass);
		$iterations = ['cost' => 15];
		$hashed_password = password_hash($pass, PASSWORD_BCRYPT, $iterations);

        $CustomerDAO = new CustomerDAO();
        $CustomerDAO->createCustomerDB($fname, $lname, $phone, $address, $zipcode, $email, $hashed_password);

    }
}