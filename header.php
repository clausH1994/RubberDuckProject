<?php 
require_once("connection/session.php");

$session = new Session();

require_once("shop/cartsession.php");

if(isset($_SESSION['cartItem'])){

$iq = 0;
	
    foreach ($_SESSION["cartItem"] as $item){
		
 				$item["quantity"];
 		$iq += $item["quantity"];
		
     }
    
   }

   else {
     $iq = 0;
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
      </ul>
    </div>
  </nav>

