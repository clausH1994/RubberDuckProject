
<?php require_once("adminLoginHandle.php"); ?>
<?php spl_autoload_register(function ($class) {
    include "../connection/" .$class . ".php";
}); ?>


<?php


$session = new Session();
$log = new AdminLoginHandle();
//look for logout keyword and log the user out if == 1
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $log->adminLogout();
    $msg = "You are now logged out.";
} elseif ($session->adminlogged_in()) {
    $redirect = new Redirector("employeeView.php");
}
// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.

    $log->adminLogin($_POST['email'], $_POST['pass']);
    $msg = $log->message;
}
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html" />
    <link rel="stylesheet" href="../css/style.css">
</head>

<body >
    <?php
    if (!empty($msg)) {
        echo "<p>" . $msg . "</p>";
    }
    ?>
    <div class="center">
        <div>


            <h2>Please login</h2>
            <form method="post">
                email:
                <input type="text" name="email" maxlength="30" />
                Password:
                <input type="password" name="pass" maxlength="30" />
                <input type="submit" name="submit" value="Login" />
            </form>
        </div>
    </div>
</body>

</html>