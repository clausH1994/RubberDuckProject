<?php require_once "connection/dbcon.php";?>
<?php include "connection/session.php"?>
<?php include "header.php" ?>


 <?php
//$dbCon = dbCon();
//$query = $dbCon->prepare("SELECT * FROM product");
//$query->execute();
//$getProducts = $query->fetchAll();
//var_dump($getProducts);
?>


    <div class="row">
    <?php
    $db_handle = new DBController();
	$product_array = $db_handle->runQuery("SELECT * FROM product ORDER BY productID ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $aNumber=> $value){
	?>
        <form method="post" action="index.php?action=add&productID=<?php echo $product_array[$aNumber]["productID"]; ?>">      
        <div class="col s12 m3">
          <div class="card">
          <span class="card-title"><?php echo $product_array[$aNumber]["name"]; ?></span>
            <div class="card-image">
              <img src="<?php echo $product_array[$aNumber]["image"]; ?>" id="card">
            </div>
            <div class="card-content">
              <p><?php echo $product_array[$aNumber]["description"]; ?></p>
            </div>
            <div>
                <input type="text" name="quantity" value="1" size="1" />
                <input class="waves-effect waves-light btn" type="submit" value="Add to cart" class="addBtn" />
            </div>
          </div>
        </div>
    </form>

        <?php
        
		}
	}
	?>
    </div>

    <?php
    $total_items = 0;
    $_SESSION["total-item"] = $total_items;
    $total_items = $total_items + $_POST["quantity"];
 ?>
