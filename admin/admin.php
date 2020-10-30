<?php require_once("../connection/dbcon.php"); ?>
<?php require_once("../connection/session.php"); ?>
<?php require_once("../connection/Redirector.php"); ?>
<?php  spl_autoload_register(function ($class)
    {include $class.".php";}); ?>


<?php


$session = new Session();
//look for logout keyword and log the user out if == 1
if (isset($_GET['logout']) && $_GET['logout'] == 1) {

    $log = new adminLog();
    $log->adminLogout();
    $msg = "You are now logged out.";
} elseif ($session->adminlogged_in()) {
    $redirect = new Redirector("employeeOverview.php");
}
// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
    $log = new adminLog();
    $log->adminLogin($_POST['email'], $_POST['pass']);
    $msg = $login->message;
}
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body class="center">
    <div>
        <?php
        if (!empty($msg)) {
            echo "<p>" . $msg . "</p>";
        }
        ?>

        <h2>Please login</h2>
        <form action="" method="post">
            email:
            <input type="text" name="email" maxlength="30" />
            Password:
            <input type="password" name="pass" maxlength="30" />
            <input type="submit" name="submit" value="Login" />
        </form>
    </div>
</body>

</html>