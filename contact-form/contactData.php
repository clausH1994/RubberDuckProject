<?php
require_once("../connection/session.php");

$session = new Session();

$myMail = "mikkelferrari123@gmail.com";
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$msg = $_POST['message'];

$RegXp = "";


if (isset($_POST['submit'])) {
    if (!empty($_POST['token'])) {
        if (hash_equals($_SESSION['token'], $_POST['token'])) {
            unset($_SESSION['token']);
            $body = "$msg \n\n Name: $name\n Email: $email";
            mail($myMail, $subject, $body, "From: $email\n");
            echo "Email sendt";
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
}
