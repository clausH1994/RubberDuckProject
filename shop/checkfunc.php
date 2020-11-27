<?php
require_once("../connection/dbcon.php");
spl_autoload_register(function ($class)
	{include $class.".php";});

	require_once("../connection/session.php");
	$session = new Session();

	$cartController = new CartController();
	if (isset($_SESSION["cartItem"])) {
		$cartController->existingCart($_SESSION["cartItem"]);
	}
	if(!empty($_GET["action"])) {
		if (isset($_GET['code'])){
			$code= $_GET['code'];}

		//start the switch/case
		switch($_GET["action"]) {
		//adding items to cart
			case "add":
				$cartController->cartAdd($code, $_POST["quantity"]);
				$user = $_SESSION['user'];
				$userID = $_SESSION['user_id'];
				$_SESSION  = $cartController->itemArray;
				$_SESSION['user'] = $user;
				$_SESSION['user_id'] = $userID;
			break;
		//Remove item from cart
			case "remove":
				$cartController->cartRemove($code);
				$user = $_SESSION['user'];
				$userID = $_SESSION['user_id'];
				$_SESSION  = $cartController->itemArray;
				$_SESSION['user'] = $user;
				$_SESSION['user_id'] = $userID;
				break;
		//Empty the entire cart
			case "empty":
				unset($_SESSION["cartItem"]);
			break;
		}
	}

$iq = 0;
	
    foreach ($_SESSION["cartItem"] as $item){
		
				$item["quantity"];
		$iq += $item["quantity"];
		
		}

$uid = $_SESSION['user_id'];
$date = date("Y-m-d");
$status = 0;

$details = "this is a stupid dummy text that i can't be bothered with writing";

try {

	$dbcon = dbCon();

$sql = "INSERT INTO Invoice (`date`, `details`, `status`) VALUES (:date, :details, :status)";
$query = $dbcon->prepare($sql);

$sanitized_details = htmlspecialchars(trim($details));
$query->bindParam(':date', $date);
$query->bindParam(':status', $sanitized_details);
$query->bindParam(':details', $details);


$query->execute();

$last_id = $dbcon->lastInsertId(); 

$sql = "INSERT INTO `Order` (`date`, `numberOfProducts`, `customer`, `invoice`) VALUES (:date, :numberOfProducts, :customer, :invoice)";
$query = $dbcon->prepare($sql);

$query->bindParam(':date', $date);
$query->bindParam(':numberOfProducts', $iq);
$query->bindParam(':customer', $uid);
$query->bindParam(':invoice', $last_id);


$query->execute();

$last_order = $dbcon->lastInsertId();


foreach ($_SESSION["cartItem"] as $items){
			$product = $items["id"];
			$quan = $items["quantity"];
			$price = $items["price"];

			$sql = "INSERT INTO Orderline (`price`, `quantity`, `order`, `product`) VALUES (:price, :quantity, :order, :product)";
			$query = $dbcon->prepare($sql);
			
			$query->bindParam(':price', $price);
			$query->bindParam(':quantity', $quan);
			$query->bindParam(':order', $last_order);
			$query->bindParam(':product', $product);

			$query->execute();
	
		}
	}

catch(\Throwable $ex){
  var_dump($query);
    echo "Error:" . $ex->getMessage();
  }

header("Location: ../index.php?status=bought");