<?php
require_once "../connection/dbcon.php";


if (isset($_POST['submit'])) {

    
$Name = $_POST['Name'];
$Color = $_POST['Color'];
$Price = $_POST['Price'];
$Image = $_POST['Image'];
$Quantity = $_POST['Quantity'];
$description = $_POST['description'];
}

try {

$sql = "INSERT INTO product (`name`, `color`, `price`, `image`,`Quantity`, `description`) VALUES (:name, :color, :price, :image, :quantity, :description)";
$query = dbCon()->prepare($sql);

//$query = dbCon()->prepare("INSERT INTO product (`name`, `color`, `price`, `image`, `description`) VALUES ('$Name', '$Color', '$Price', '$Image', '$description')");

$sanitized_name = htmlspecialchars(trim($Name));
$sanitized_color = htmlspecialchars(trim($Color));
$sanitized_price = htmlspecialchars(trim($Price));
$sanitized_image = htmlspecialchars(trim($Image));
$sanitized_quantity = htmlspecialchars(trim($Quantity));
$sanitized_desc = htmlspecialchars(trim($description));
$query->bindParam(':name', $sanitized_name);
$query->bindParam(':color', $sanitized_color);
$query->bindParam(':price', $sanitized_price);
$query->bindParam(':image', $sanitized_image);
$query->bindParam(':quantity', $sanitized_quantity);
$query->bindParam(':description', $sanitized_desc);

$query->execute();
  header("Location: index.php?status=added");


echo "The item has been added.";

//}

// else{
//    header("Location: index.php?status=0");
// }

}

catch(\Throwable $ex){
  echo "Error:" . $ex->getMessage();
}