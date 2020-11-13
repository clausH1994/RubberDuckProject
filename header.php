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

<?php 
    $localTotalItem = 0;
    if(isset($_SESSION["total-item"]) ){
        $localTotalItem = $_SESSION["total-item"];
    }

?>

<nav>
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo">Logo</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="cart.php"> <?php echo $localTotalItem; ?>  Cart</a></li>
      </ul>
    </div>
  </nav>
