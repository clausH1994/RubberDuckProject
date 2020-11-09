<?php require_once "connection/dbcon.php";?>
<?php
session_start();
spl_autoload_register(function ($class)
{include"shop/".$class.".php";});

$cartController = new CartController();
if (isset($_SESSION["cartItem"])) {
    $cartController->existingCart($_SESSION["cartItem"]);
}
if(!empty($_GET["action"])) {
    if (isset($_GET['code'])){
        $code = $_GET['code'];}

    //start the switch/case
    switch($_GET["action"]) {
    //adding items to cart
	    case "add":
	        $cartController->cartAdd($code, $_POST["quantity"]);
            $_SESSION  = $cartController->itemArray;
	    break;
    //Remove item from cart
	    case "remove":
	        $cartController->cartRemove($code);
            $_SESSION  = $cartController->itemArray;
            break;
    //Empty the entire cart
	    case "empty":
		    unset($_SESSION["cartItem"]);
	    break;
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
      <a href="#" class="brand-logo">Logo</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
      </ul>
    </div>
  </nav>


<!-- <?php
$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM product");
$query->execute();
$getProducts = $query->fetchAll();
//var_dump($getProducts);

    echo '<div class="row">';

      foreach ($getProducts as $getProduct) {
      echo '
        <div class="col s12 m3">
          <div class="card">
          <span class="card-title">' . $getProduct["name"] .'</span>
            <div class="card-image">
              <img src='. $getProduct["image"]. ' id="card">
            </div>
            <div class="card-content">
              <p>' . $getProduct["description"] .'</p>
            </div>
            <div>
                <input type="text" name="quantity" value="1" size="2" />
                <input type="submit" value="Add to cart" class="addBtn" />
            </div>
          </div>
        </div>';

    }
    echo "</div>";

    
?> -->

<div class="heading">Products</div>
	<?php
    $db_handle = new DBController();
	$product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY productID ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $aNumber=> $value){
	?>
		<div class="product-item">
			<form method="post" action="index.php?action=add&code=<?php echo $product_array[$aNumber]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$aNumber]["image"]; ?>"></div>
			<div><strong><?php echo $product_array[$aNumber]["name"]; ?></strong></div>
			<div class="product-price"><?php echo $product_array[$aNumber]["price"]." DKK"; ?></div>
			<div>
                <input type="text" name="quantity" value="1" size="2" />
                <input type="submit" value="Add to cart" class="addBtn" /></div>
			</form>
		</div>
    <?php
		}
	}
	?>