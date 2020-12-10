<?php
require_once("../connection/dbcon.php");
require_once("../postalcode/PostalCodeController.php");
require_once("../connection/session.php");

$session = new Session();

if (isset($_POST["submit"])) {
    if (!empty($_POST['token'])) {
        if (hash_equals($_SESSION['token'], $_POST['token'])) {
            unset($_SESSION['token']);

            $name = $_POST["name"];
            $address = $_POST["address"];
            $postal = $_POST["postalID"];
            $city = $_POST["city"];
            $phone = $_POST["phone"];
            $email = $_POST["email"];
            $companyDesc = $_POST["description"];


            $postalCon = new PostalCodeController();
            $postalCon->CheckPostalCode($postal, $city);

            try {
                $dbCon = dbCon();

                $query = "INSERT INTO `Company` (`name`, `address`, postalID, phone, email, `description`) 
            VALUES (:name, :address , :postalID ,:phone,:email, :companyDesc)";
                $handle = $dbCon->prepare($query);

                $sanitized_name = htmlspecialchars(trim($name));
                $sanitized_address = htmlspecialchars(trim($address));
                $sanitized_postal = htmlspecialchars(trim($postal));
                $sanitized_phone = htmlspecialchars(trim($phone));
                $sanitized_email = htmlspecialchars(trim($email));
                $sanitized_companyDesc = htmlspecialchars(trim($companyDesc));

                $handle->bindParam(':name', $sanitized_name);
                $handle->bindParam(':address', $sanitized_address);
                $handle->bindParam(':postalID', $sanitized_postal);
                $handle->bindParam(':phone', $sanitized_phone);
                $handle->bindParam(':email', $sanitized_email);
                $handle->bindParam(':companyDesc', $sanitized_companyDesc);

                $handle->execute();
                $dbcon = null;
            } catch (\PDOException $ex) {
                print($ex->getMessage());
            }
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
    header("Location: aboutUs.php?status=added");
} else {
    header("Location: aboutUs.php?status=0");
};
