<?php
require_once "../connection/dbcon.php";


if (isset($_POST['submit'])) {

    
$email = $_POST['email'];
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];
$tele = $_POST['tele'];
$addresse = $_POST['adresse'];
$postnr = $_POST['postnummer'];
$by = $_POST['by'];

}

try {

$sql = "INSERT INTO Product (`code`, `name`, `color`, `price`, `image`,`Quantity`, `desc`) VALUES (:code, :name, :color, :price, :image, :quantity, :description)";
$query = dbCon()->prepare($sql);

//$query = dbCon()->prepare("INSERT INTO product (`name`, `color`, `price`, `image`, `description`) VALUES ('$Name', '$Color', '$Price', '$Image', '$description')");

$sanitized_email = htmlspecialchars(trim($email));
$sanitized_fname = htmlspecialchars(trim($fname));
$sanitized_lname = htmlspecialchars(trim($lname));
$sanitized_tele = htmlspecialchars(trim($tele));
$sanitized_addresse = htmlspecialchars(trim($addresse));
$sanitized_quantity = htmlspecialchars(trim($Quantity));
$sanitized_desc = htmlspecialchars(trim($description));
$query->bindParam(':code', $sanitized_code);
$query->bindParam(':name', $sanitized_name);
$query->bindParam(':color', $sanitized_color);
$query->bindParam(':price', $sanitized_price);
$query->bindParam(':image', $sanitized_image);
$query->bindParam(':quantity', $sanitized_quantity);
$query->bindParam(':description', $sanitized_desc);

$query->execute();
  header("Location: index.php?status=added");


echo "The item has been added.";