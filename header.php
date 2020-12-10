<?php
require_once("connection/session.php");

$session = new Session();

require_once("shop/cartsession.php");

if (isset($_SESSION['cartItem'])) {

  $iq = 0;

  foreach ($_SESSION["cartItem"] as $item) {

    $item["quantity"];
    $iq += $item["quantity"];
  }
} else {
  $iq = 0;
}

if (isset($_GET['action'])) {
  if ($_GET['action'] == "logout") {
    require_once("Customer/CustomerLogout.php");
    require_once("connection/Redirector.php");

    $cusCon = new CustomerLogout();
    $cusCon->customerLogout();
    $redirect = new Redirector("index.php");
  
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Front Page</title>
  <link rel="stylesheet" href="css/style.css">
  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<nav>
  <div class="nav-wrapper">
    <a href="index.php" class="brand-logo">Logo</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="cart.php"> <?php echo $iq ?> Cart</a></li>
      <li><a href="about.php">About Us</a></li>
      <?php
      if ($session->userLogged_in()) {
        echo "<li><a href='index.php?action=logout'>Logout</a></li>";
      } else {
        echo "<li><a href='Customer/customerLoginView.php'>Login</a></li>";
      }
      ?>
    </ul>
  </div>
</nav>