<?php require_once "connection/dbcon.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Front Page</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<?php
$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM product");
$query->execute();
$getProducts = $query->fetchAll();
//var_dump($getProducts);

    echo '<div class="row">';

      foreach ($getProducts as $getProduct) {
      echo "
        <div class='col s12 m3'>
          <div class='card'>
          <span class='card-title'>" . $getProduct['name'] ."</span>
            <div class='card-image'>
              <img src=". $getProduct['image']. " id='card'>
            </div>
            <div class='card-content'>
              <p>" . $getProduct['description'] .".</p>
            </div>
            <div class='card-action'>
              <a href='#'>This is a link</a>
            </div>
          </div>
        </div>";

    }
    echo "</div>";
?>
