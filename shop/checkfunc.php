<?php
$user = '0';
$userID = 0;
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


require_once("../connection/dbcon.php");

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


$sql = "INSERT INTO Invoice (`date`, `details`, `status`) VALUES (:date, :details, :status)";
$query = dbCon()->prepare($sql);

$sanitized_details = htmlspecialchars(trim($details));
$query->bindParam(':date', $date);
$query->bindParam(':status', $sanitized_details);
$query->bindParam(':details', $details);


//$query->execute();
//header("Location: ../index.php?status=added");


}

catch(\Throwable $ex){
  var_dump($query);
    echo "Error:" . $ex->getMessage();
  }

  $dbCon = 

  var_dump($invoice);

//try {

//$sql = "INSERT INTO Product (`code`, `name`, `color`, `price`, `image`,`Quantity`, `desc`) VALUES (:code, :name, :color, :price, :image, :quantity, :description)";
//$query = dbCon()->prepare($sql);

//$query = dbCon()->prepare("INSERT INTO product (`name`, `color`, `price`, `image`, `description`) VALUES ('$Name', '$Color', '$Price', '$Image', '$description')");

// $sanitized_email = htmlspecialchars(trim($email));
// $sanitized_fname = htmlspecialchars(trim($fname));
// $sanitized_lname = htmlspecialchars(trim($lname));
// $sanitized_tele = htmlspecialchars(trim($tele));
// $sanitized_addresse = htmlspecialchars(trim($addresse));
// $sanitized_quantity = htmlspecialchars(trim($Quantity));
// $sanitized_desc = htmlspecialchars(trim($description));
// $query->bindParam(':code', $sanitized_code);
// $query->bindParam(':name', $sanitized_name);
// $query->bindParam(':color', $sanitized_color);
// $query->bindParam(':price', $sanitized_price);
// $query->bindParam(':image', $sanitized_image);
// $query->bindParam(':quantity', $sanitized_quantity);
// $query->bindParam(':description', $sanitized_desc);

// $query->execute();
//   header("Location: index.php?status=added");


// echo "The item has been added.";