<?php
spl_autoload_register(function ($class) {
    include "../connection/" . $class . ".php";
});

require_once("AdminLoginHandle.php");

 $session = new Session();
  if ($session->confirm_adminlogged_in()) {
      $redirect = new Redirector("../admin/adminLoginView.php");
  } 
    if (isset($_POST['logout'])) {
        $log = new adminLoginHandle();
        $log->adminLogout();
        $redirect = new Redirector("../admin/adminLoginView.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;" />
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>

<div class="headerAdmin">
    <a href="../Backend/index.php" class="waves-effect waves-light btn grey headButton">Products</a>
    <a href="../admin/employeeView.php" class="waves-effect waves-light btn grey headButton">Employee</a>
    <a href="../news/newsOverView.php" class="waves-effect waves-light btn grey headButton">News</a>
    <a href="../about/aboutUs.php" class="waves-effect waves-light btn grey headButton">About</a>
    <a href="../openingHours/openingHours.php" class="waves-effect waves-light btn grey headButton">openingHours</a>
    <a href="../invoice/invoice-overview.php" class="waves-effect waves-light btn grey headButton">Invoices</a>
    <form method="post">
        <input id="btnLogout" class="grey btn" type="submit" name="logout" value="Logout" />
    </form>
</div>
</html>