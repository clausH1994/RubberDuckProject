<?php
require_once("../connection/session.php");
require_once("../connection/Redirector.php");

$session = new Session();

$myMail = "jonas@jonaskp.dk";
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
            $redirect = new Redirector("../sent.php");
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
}