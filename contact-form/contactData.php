<?php
$myMail = "demoACC@demo.dk";
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$msg = $_POST['message'];

$RegXp = "";


if(isset($_POST['submit'])){
    $body = "$msg \n\n Name: $name\n Email: $email";
    mail($myMail,$subject,$body,"From: $email\n");
    echo "Email sendt";
}