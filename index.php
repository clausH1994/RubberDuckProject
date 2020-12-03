<?php require_once "connection/dbcon.php";?>
<?php include "header.php"
?>

<?php
if (isset($_GET['status'])) {
  if ($_GET['status'] == "accountUpdated") {    
    echo "<script>M.toast({html: 'The Account has been successfully Updated!'})</script>";
  }
}
$db_handle = new DBController();
$product_array = $db_handle->runQuery("SELECT * FROM Product p ORDER BY ID ASC");


$dbcon = dbCon();

$newQuery = "SELECT * FROM News n, SpecialNews sn, DailySpecial ds
WHERE n.newsID = sn.news 
AND sn.daily = ds.dailyID
ORDER BY newsID DESC";
$newsHandle = $dbcon->prepare($newQuery);
$newsHandle->execute();
$lastNews = $newsHandle->fetchAll();

$colorAllSql = "SELECT * FROM Color";
$handleAllColor = $dbcon->prepare($colorAllSql);
$handleAllColor->execute();
$allColor = $handleAllColor->fetchAll();

$categoryAllSql = "SELECT * FROM Category";
$handleAllCategory = $dbcon->prepare($categoryAllSql);
$handleAllCategory->execute();
$allCategory = $handleAllCategory->fetchAll();

if (!empty($lastNews)) {
  $newsID = $lastNews[0]["newsID"];

  $query = "SELECT * FROM NewsAndSpecialData WHERE newsID = $newsID ORDER BY productID DESC";
  $handle = $dbcon->prepare($query);
  $handle->execute();

  $newsAndSpecialData = $handle->fetchAll();



  $i = 0;
?>

  <div class="row borders">
    <h4>Projects with a discount</h4>
    <div class="col s12 m3">
      <p>Latest News</p>
      <div class="card">

        <span class="card-title"><?php echo $lastNews[0]["title"] ?></span>

        <hr>
        <div class="card-content">
          <p><?php echo $lastNews[0]["description"]; ?></p>
        </div>
        <div style="display: flex;">
          <p><?php echo $lastNews[0]["date"]; ?></p>
          <p style="margin-left:40%">discount <?php echo $lastNews[0]["discount"]; ?> %</p>
        </div>
      </div>

    </div>

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


          $colorID = $discountedProduct[0]["color"];
          $colorQuery = "SELECT * FROM Color WHERE colorID = $colorID limit 1";
          $handleColor = $dbcon->prepare($colorQuery);
          $handleColor->execute();
          $color = $handleColor->fetchAll();

    ?>

          <form method="post" action="index.php?action=add&code=<?php echo $discountedProduct[0]["code"]; ?>">
            <div class="col s12 m3">
              <div class="card">
                <span class="card-title"><?php echo $discountedProduct[0]["name"]; ?></span>
                <div class="card-image">
                  <img src="<?php echo $discountedProduct[0]["image"]; ?>" id="image">
                </div>
                <div class="card-content">
                  <p><?php echo $discountedProduct[0]["desc"]; ?></p>
                </div>
                <div>
                  <p> Color: <?php echo $color[0]['name']; ?></p>
                </div>
                <div>
                  <p class="price">Price: <?php echo $discountedProduct[0]["price"]; ?>DKK</p>
                </div>
                <div>
                  <p>Price: <?php echo $discountedPrice ?>DKK</p>
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
  }
  ?>

  </div>
  <div class="row">
    <form method="post" action="filteredProducts.php" ?>
      <div class="input-field col s2" style="padding:40px; padding-bottom:0;">
        <h5>Filter products:</h5>
      </div>
      <div class="input-field col s1">
        <p>Color:</p>
        <select name="filteredColor" class="browser-default">
          <?php
          echo "<option value='' selected disabled hidden>Choose here</option>";
          foreach ($allColor as $Color) {
            echo "<option value='" . $Color['colorID'] . "'>" . $Color['name'] . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="input-field col s1">
        <p>Category:</p>
        <select name="filteredCategory" class="browser-default">
          <?php
          echo "<option value='' selected disabled hidden>Choose here</option>";
          foreach ($allCategory as $category) {
            echo "<option value='" . $category['categoryID'] . "'>" . $category['name'] . "</option>";
          }
          ?>
        </select>
      </div>
      <div class="input-field col s1" style="padding:55px; padding-bottom:0;">
        <button class="btn waves-effect waves-light" type="submit" name="filter">filter</button>
      </div>
    </form>
  </div>

  <div class="row">
    <h4>All products</h4>
    <?php

    if (!empty($product_array)) {
      foreach ($product_array as $aNumber => $value) {

        $colorID = $product_array[$aNumber]["color"];
        $colorQuery = "SELECT * FROM Color WHERE colorID = $colorID limit 1";
        $handleColor = $dbcon->prepare($colorQuery);
        $handleColor->execute();
        $color = $handleColor->fetchAll();


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
                <p> Color: <?php echo $color[0]['name']; ?></p>
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
