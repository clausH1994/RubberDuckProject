<?php
require_once "../connection/dbcon.php";
require_once "../connection/session.php";

$session = new Session();

$dbcon = dbCon();

if (isset($_POST['submit'])) {
  if (!empty($_POST['token'])) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {
      unset($_SESSION['token']);


      $Code = $_POST['Code'];
      $Name = $_POST['Name'];
      $Color = $_POST['Color'];
      $Price = $_POST['Price'];
      $Quantity = $_POST['Quantity'];
      $description = $_POST['description'];

      $category = $_POST['category'];

      if (($_FILES['Image']['type'] == "image/jpeg" ||
        $_FILES['Image']['type'] == "image/pjpeg" ||
        $_FILES['Image']['type'] == "image/gif" ||
        $_FILES['Image']['type'] == "image/jpg" ||
        $_FILES['Image']['type'] == "image/png") && ($_FILES['Image']['size'] < 3000000)) {
        if ($_FILES['Image']['error'] > 0) {
          "Error: " . $_FILES['Image']['error'];
        } else {
          "Name: " . $_FILES['Image']['name'] . "<br>";
          "Type: " . $_FILES['Image']['type'] . "<br>";
          "Size: " . ($_FILES['Image']['size'] / 1024) . "<br>";
          "Tmp_name: " . $_FILES['Image']['tmp_name'] . "<br>";
          if (file_exists("../img/" . $_FILES['Image']['name'])) {
            echo "can't upload: " . $_FILES['Image']['name'] . " Exists";
          } else {
            move_uploaded_file(
              $_FILES['Image']['tmp_name'],
              "../img/" . $_FILES['Image']['name']
            );
            "stored in: img/" . $_FILES['Image']['name'];

            $Image = "img/" . $_FILES['Image']['name'];

            try {

              $sql = "INSERT INTO Product (`code`, `name`, `color`, `price`, `image`,`Quantity`, `desc`) VALUES (:code, :name, :color, :price, :image, :quantity, :description)";
              $query = $dbcon->prepare($sql);


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

              $productID = $dbcon->lastInsertId();

              $categorySql = "INSERT INTO ProductCategory(product, category) VALUES (:productId, :categoryId)";
              $categoryQuery = $dbcon->prepare($categorySql);

              $sanitized_productId = htmlspecialchars(trim($productID));
              $categoryQuery->bindParam(':productId', $sanitized_productId);

              $sanitized_category = htmlspecialchars(trim($category));
              $categoryQuery->bindParam(':categoryId', $sanitized_category);

              $categoryQuery->execute();

              header("Location: index.php?status=added");
            } catch (\Throwable $ex) {
              echo "Error:" . $ex->getMessage();
            }
          }
        }
      } else {
        die('CSRF VALIDATION FAILED');
      }
    } else {
      die('CSRF TOKEN NOT FOUND. ABORT');
    }
  } else {
    header("Location: index.php?status=toBig");
  }
}
