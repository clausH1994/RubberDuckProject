<?php
spl_autoload_register(function ($class)
	{include $class.".php";});

	require_once("connection/session.php");
	$session = new session();

	$cartController = new CartController();
	if (isset($_SESSION["cartItem"])) {
		$cartController->existingCart($_SESSION["cartItem"]);
	}
	if(!empty($_GET["action"])) {
		if (isset($_GET['productID'])){
			$productID = $_GET['productID'];}

		//start the switch/case
		switch($_GET["action"]) {
		//adding items to cart
			case "add":
				$cartController->cartAdd($productID, $_POST["quantity"]);
				$_SESSION  = $cartController->itemArray;
			break;
		//Remove item from cart
			case "remove":
				$cartController->cartRemove($productID);
				$_SESSION  = $cartController->itemArray;
				break;
		//Empty the entire cart
			case "empty":
				unset($_SESSION["cartItem"]);
			break;
		}
	}
?>