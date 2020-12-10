<?php
require_once "connection/dbcon.php";
include "shop/cartsession.php";
include "connection/Redirector.php";


$dbcon = dbCon();

$colorAllSql = "SELECT * FROM Color";
$handleAllColor = $dbcon->prepare($colorAllSql);
$handleAllColor->execute();
$allColor = $handleAllColor->fetchAll();

$categoryAllSql = "SELECT * FROM Category";
$handleAllCategory = $dbcon->prepare($categoryAllSql);
$handleAllCategory->execute();
$allCategory = $handleAllCategory->fetchAll();


if (isset($_POST['filteredColor'])) {
    $filteredColor = $_POST['filteredColor'];
}
if (isset($_POST['filteredCategory'])) {
    $filteredCategory = $_POST['filteredCategory'];
}


if (isset($_POST['filter'])) {
    if (isset($_POST['filteredColor']) && isset($_POST['filteredCategory'])) {

        $query = $dbcon->prepare("SELECT DISTINCT p.* FROM Product p, ProductCategory pc WHERE pc.category = :category 
        AND pc.product = p.ID
        AND color = :color");

        $sanitized_category = htmlspecialchars(trim($filteredCategory));
        $query->bindParam(':category', $sanitized_category);

        $sanitized_color = htmlspecialchars(trim($filteredColor));
        $query->bindParam(':color', $sanitized_color);
    } elseif (isset($_POST['filteredColor'])) {

        $query = $dbcon->prepare("SELECT * FROM Product p WHERE color = :color ORDER BY ID ASC");
        $sanitized_filteredColor = htmlspecialchars(trim($filteredColor));
        $query->bindParam(':color', $sanitized_filteredColor);
    } elseif (isset($_POST['filteredCategory'])) {

        $query = $dbcon->prepare("SELECT DISTINCT p.* FROM Product p, ProductCategory pc WHERE pc.category = :category AND pc.product = p.ID");
        $sanitized_category = htmlspecialchars(trim($filteredCategory));
        $query->bindParam(':category', $sanitized_category);
    } else {
        $redirect = new Redirector("index.php");
    }
    $query->execute();
}

if (!empty($query)) {
    $product_array = $query->fetchAll();
}

require_once "header.php";
?>

<div class="row" style="margin:0;">
    <form method="post" ?>
        <div class="input-field col s2" style="padding:30px; padding-bottom:0;">
            <h5>Filter products:</h5>
        </div>
        <div class="input-field col s1">
            <p>Color:</p>
            <select name="filteredColor" class="browser-default">
                <?php
                echo "<option value='' disabled hidden>Choose here</option>";
                foreach ($allColor as $color) {
                    if ($color['colorID'] == $filteredColor) {
                        $select_attribute = 'selected';
                    }
                    echo "<option value='" . $color['colorID'] . "' $select_attribute>" . $color['name'] . "</option>";
                    $select_attribute = "";
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
                    if ($category['categoryID'] == $filteredCategory) {
                        $select_attribute = 'selected';
                    }
                    echo "<option value='" . $category['categoryID'] . "' $select_attribute>" . $category['name'] . "</option>";
                    $select_attribute = "";
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
    <h4>filtered products</h4>
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