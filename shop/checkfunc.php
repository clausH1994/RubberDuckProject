<?php
require_once("../connection/dbcon.php");
require_once("cartsession.php");

function killsession() {
	unset($_SESSION["cartItem"]);
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
killsession();

header("Location: ../index.php?status=bought");