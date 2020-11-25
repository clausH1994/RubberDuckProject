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

$i = 0;
?>
<div style="padding: 5px 5%;">
  <div class="row borders">
    <h4>Projects with a discount</h1>
      <?php
      if (!empty($newsAndSpecialData)) {

        foreach ($newsAndSpecialData as $aNumber) {

          if ($i < 6) {
            $productID = $aNumber["productID"];
            $discountProductQuery = "SELECT * FROM Product WHERE ID = $productID limit 1";
            $handleDiscount = $dbcon->prepare($discountProductQuery);
            $handleDiscount->execute();
            $discountedProduct = $handleDiscount->fetchAll();
            

            $discount = ($aNumber["discount"] / 100) * $discountedProduct[0]["price"];
            $discountedPrice =  $discountedProduct[0]["price"] - $discount;

      ?>

            <form method="post" action="index.php?action=add&code=<?php echo $discountedProduct[0]["code"]; ?>">
              <div class="col s12 m2">
                <div class="card">
                  <span class="card-title"><?php echo $discountedProduct[0]["name"]; ?></span>
                  <div class="card-image">
                    <img src="<?php echo $discountedProduct[0]["image"]; ?>" id="image">
                  </div>
                  <div class="card-content">
                    <p><?php echo $discountedProduct[0]["desc"]; ?></p>
                  </div>
                  <div>
                    <p class="price">Price: <?php echo $discountedProduct[0]["price"]; ?>DKK</p>
                  </div>
                  <div>
                    <p >Price: <?php echo $discountedPrice ?>DKK</p>
                  </div>
                  <div>
                    <label for="quantity">quantity:</label>
                    <input type="text" name="quantity" value="1" size="1" />
                    <button class="waves-effect waves-light btn" type="submit">Add to cart</button>
                  </div>
                </div>
              </div>
            </form>

      <?php
      $i++;
           }
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
                <label for="quantity">quantity:</label>
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

</div>