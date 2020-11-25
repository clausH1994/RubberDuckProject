<?php
$user = '0';
$userID = 0;
spl_autoload_register(function ($class)
	{include $class.".php";});

	require_once("connection/Session.php");
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
?>