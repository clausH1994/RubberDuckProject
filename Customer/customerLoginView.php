<?php
require_once("CustomerController.php");
require_once("../connection/session.php");

$cusCon = new CustomerController();
$session = new Session();

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    //$cusCon->customerLogout();
    //$msg = "You are now logged out.";
} elseif ($session->userlogged_in()) {
    $redirect = new Redirector("../index.php");
}

?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <div class="container" style="margin-top:25vh;">
            <?php

            if (isset($_GET['status'])) {
                if ($_GET['status'] == "registered") {
                    echo "<script>M.toast({html:'The acount has been Registered!'})</script>";
                }
            }

            if (isset($_POST['submit'])) { // Form has been submitted.

                $regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";
                if (!preg_match($regexp, $_POST['email'])) {
                    echo "<p style='color: red; font-size: 20px'>please enter a valid mail</p>";
                } else {

                    $cusCon->customerLogin($_POST['email'], $_POST['pass']);
                    $msg = $cusCon->message;
                }
            }
            if (!empty($msg)) {
                echo "<p>" . $msg . "</p>";
            }


            ?>
            <h2>Please Login As Customer</h2>
            <form method="post">
                Email:
                <input type="text" name="email" maxlength="30" required />
                Password:
                <input type="password" name="pass" maxlength="30" required />
                <button class="btn waves-effect waves-light" type="submit" name="submit">Login</button>
                <a style="margin-left:70%" href="registerCustomerView.php">Register as Customer</a>
            </form>
        </div>
    </div>
</body>