<?php require_once "connection/dbcon.php"; ?>
<?php include "shop/cartsession.php" ?>
<?php include "header.php" ?>
<?php
$db_handle = new DBController();
$product_array = $db_handle->runQuery("SELECT * FROM Product ORDER BY ID ASC");

$dbcon = dbCon();
$query = "SELECT * FROM NewsAndSpecialData ORDER BY newsID DESC";
$handle = $dbcon->prepare($query);
$handle->execute();

$newsAndSpecialData = $handle->fetchAll();

?>
<div class="row">

  <?php
  if (!empty($newsAndSpecialData)) {

    foreach ($newsAndSpecialData as $aNumber) {

      $productID = $aNumber["productID"];
      $discountProductQuery = "SELECT * FROM Product WHERE ID = $productID LIMIT 1";
      $discountedProduct = $dbcon->prepare($query);
      $discountedProduct->execute();
      
  ?>
      <div class="borders">
        <form method="post" action="index.php?action=add&code=<?php echo $discountedProducts[$aNumber]["code"]; ?>">
          <div class="col s12 m3">
            <div class="card">
              <span class="card-title"><?php echo $discountedProducts[$aNumber]["name"]; ?></span>
              <div class="card-image">
                <img src="<?php echo $discountedProducts[$aNumber]["image"]; ?>" id="image">
              </div>
              <div class="card-content">
                <p><?php echo $discountedProducts[$aNumber]["desc"]; ?></p>
              </div>
              <div>
                <p><?php echo $discountedProducts[$aNumber]["price"]; ?></p>
              </div>
              <div>
                <input type="text" name="quantity" value="1" size="1" />
                <button class="waves-effect waves-light btn" type="submit">Add to cart</button>
              </div>
            </div>
          </div>
        </form>
      </div>
  <?php

    }
  }
  ?>

</div>

<div class="row">
  <?php

  if (!empty($product_array)) {
    foreach ($product_array as $aNumber => $value) {
  ?>
      <form method="post" action="index.php?action=add&code=<?php echo $product_array[$aNumber]["code"]; ?>">
        <div class="col s12 m3">
          <div class="card">
            <span class="card-title"><?php echo $product_array[$aNumber]["name"]; ?></span>
            <div class="card-image">
              <img src="<?php echo $product_array[$aNumber]["image"]; ?>" id="image">
            </div>
            <div class="card-content">
              <p><?php echo $product_array[$aNumber]["desc"]; ?></p>
            </div>
            <div>
              <p>Price: <?php echo $product_array[$aNumber]["price"]; ?> DKK</p>
            </div>
            <div>
              <input type="text" name="quantity" value="1" size="1" />
              <button class="waves-effect waves-light btn" type="submit">Add to cart</button>
            </div>
          </div>
        </div>
      </form>

  <?php

    }
  }
  ?>
</div>