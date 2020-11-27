<?php
require_once "../connection/dbcon.php";


if (isset($_POST['submit'])) {


  $Code = $_POST['Code'];
  $Name = $_POST['Name'];
  $Color = $_POST['Color'];
  $Price = $_POST['Price'];
  $Quantity = $_POST['Quantity'];
  $description = $_POST['description'];


  if (($_FILES['Image']['type'] == "image/jpeg" ||
    $_FILES['Image']['type'] == "image/pjpeg" ||
    $_FILES['Image']['type'] == "image/gif" ||
    $_FILES['Image']['type'] == "image/jpg" ||
    $_FILES['Image']['type'] == "image/png") && ($_FILES['Image']['size'] < 3000000)) {
    if ($_FILES['Image']['error'] > 0) {
      echo "Error: " . $_FILES['Image']['error'];
    } else {
      echo "Name: " . $_FILES['Image']['name'] . "<br>";
      echo "Type: " . $_FILES['Image']['type'] . "<br>";
      echo "Size: " . ($_FILES['Image']['size'] / 1024) . "<br>";
      echo "Tmp_name: " . $_FILES['Image']['tmp_name'] . "<br>";
      if (file_exists("../img/" . $_FILES['Image']['name'])) {
        echo "can't upload: " . $_FILES['Image']['name'] . " Exists";
      } else {
        move_uploaded_file(
          $_FILES['Image']['tmp_name'],
          "../img/" . $_FILES['Image']['name']
        );
        echo "stored in: img/" . $_FILES['Image']['name'];
        
        $Image = "img/".$_FILES['Image']['name'];

        try {

          $sql = "INSERT INTO Product (`code`, `name`, `color`, `price`, `image`,`Quantity`, `desc`) VALUES (:code, :name, :color, :price, :image, :quantity, :description)";
          $query = dbCon()->prepare($sql);
        
        
          $sanitized_code = htmlspecialchars(trim($Code));
          $sanitized_name = htmlspecialchars(trim($Name));
          $sanitized_color = htmlspecialchars(trim($Color));
          $sanitized_price = htmlspecialchars(trim($Price));
          $sanitized_image = htmlspecialchars(trim($Image));
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
        
        
        } catch (\Throwable $ex) {
          echo "Error:" . $ex->getMessage();
        }
      }
    }
  } else {
    header("Location: index.php?status=toBig");
  }
}

 
