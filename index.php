<?php require_once "connection/dbcon.php";?>
<?php include "shop/cartsession.php"?>

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
	$product_array = $db_handle->runQuery("SELECT * FROM Product ORDER BY ID ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $aNumber=> $value){
	?>
        <form method="post" action="index.php?action=add&code=<?php echo $product_array[$aNumber]["code"]; ?>">      
        <div class="col s12 m3">
          <div class="card">
          <span class="card-title"><?php echo $product_array[$aNumber]["name"]; ?></span>
            <div class="card-image">
              <img src="<?php echo $product_array[$aNumber]["image"]; ?>" id="card">
            </div>
            <div class="card-content">
              <p><?php echo $product_array[$aNumber]["desc"]; ?></p>
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
