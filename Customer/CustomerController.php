<?php
require_once("CustomerDAO.php");
require_once("../postalcode/POstalCodeController.php");
require_once("../connection/Redirector.php");

class CustomerController
{
    public $message;

    public function customerLogin($email, $pass)
    {

        $email = htmlspecialchars(trim($email));
        $pass = htmlspecialchars(trim($pass));
        $query = dbCon()->prepare("SELECT customerID, email, pass FROM Customer WHERE email = '{$email}' LIMIT 1");

        if ($query->execute()) {
            $found_user = $query->fetchAll();

            if (count($found_user) == 1) {
                if (password_verify($pass, $found_user[0]['pass'])) {
                    $_SESSION['user_id'] = $found_user[0]['customerID'];
                    $_SESSION['user'] = $found_user[0]['email'];
                    $redirect = new Redirector("../index.php");
                } else {

                    // username/password combo was not found in the database
                    $this->message = "Email/password combination incorrect.<br />
					Please make sure your caps lock key is off and try again.";
                }
            } else {
                $this->message = "No such Email in the database.<br />
				Please make sure your caps lock key is off and try again.";
            }
        }
    }

    public function customerLogout()
    {
        // Four steps to closing a session
        // (i.e. logging out)

        // 1. Find the session
        // This is done with session_start()
        // in the session handle class

        // 2. Unset all the session variables
        $_SESSION = array();

        // 3. Destroy the session cookie
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }

        // 4. Destroy the session
        session_destroy();
    }

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
        $redirect = new Redirector("CustomerLoginView.php?status=registered");
    }

    public function readCustomerById($customerID)
    {
        $customerDAO = new customerDAO();
		$result = $customerDAO->readCustomerByIdDB($customerID);

		return $result;
    }

    public function updateCustomer($fname, $lname, $pass, $phone, $email, $address, $postal, $customerID, $city)
    {
        $postalCon = new PostalCodeController();
        $postalCon->CheckPostalCode($postal, $city);
        $customerDAO = new customerDAO();
		$customerDAO->updateCustomerDB($fname, $lname, $pass, $phone, $email, $address, $postal, $customerID);
		$redirect = new Redirector("../index.php?status=accountUpdated");
    }
}
