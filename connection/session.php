<?php
class Session
{
	public function __construct()
	{
		session_start();
	}

	public function adminlogged_in()
	{
		return isset($_SESSION['admin_id']);
	}

	public function confirm_adminlogged_in()
	{
		if (!$this->adminlogged_in()) {
			$redirect = new Redirector("../admin/adminLoginView.php");
		}
	}
}
	spl_autoload_register(function ($class)
	{include"shop/".$class.".php";});

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
