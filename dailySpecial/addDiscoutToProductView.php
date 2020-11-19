<?php
require_once("../admin/adminHeader.php");
require_once("DailySpecialController.php");

$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM Product");
$query->execute();
$getProducts = $query->fetchAll();

$dailyCon = new DailySpecialController();

if (isset($_SESSION["discountProducts"])) {
    $dailyCon->existingDiscountProduct($_SESSION["discountProducts"]);
}

if (!empty($_GET["action"])) {
    if (isset($_GET['ID'])) {
        $productID = $_GET['ID'];
    }

    //start the switch/case
    switch ($_GET["action"]) {
            //adding items to cart
        case "add":
            $dailyCon->addtoDiscountProduct($productID);
            $_SESSION = $dailyCon->productArray;
            var_dump($_SESSION);
            break;
            //Remove item from cart
        case "remove":
            $dailyCon->removeDiscountProduct($productID);
            $_SESSION  = $dailyCon->productArray;
            break;
        case "empty":
            unset($_SESSION["discountProducts"]);
            break;
    }
}
?>

<body>
    <div class="container">
        <div class="row" style="margin-top:40px;">


            <form method="post">

                <div class="col s12">

                    <div class="col s6">
                        <h4>list of discounted products</h4>

                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <?php if (isset($_SESSION["discountProducts"])) { ?>
                                
                                <tbody>
                                    <?php
                                    foreach ($_SESSION["discountProducts"] as $getDiscountProduct) {
                                        echo "<tr>";
                                        echo "<td>" . $getDiscountProduct['productID'] . "</td>";
                                        echo "<td>" . $getDiscountProduct['name'] . "</td>";
                                        echo "<td>" . $getDiscountProduct['price'] . "</td>";
                                        echo "<td>" . $getDiscountProduct['quantity'] . "</td>";
                                        echo '<td><a href="addDiscoutToProductView.php?action=remove&ID=' . $getDiscountProduct['productID'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Remove! are you sure?\')">Remove</a></td>';
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            <?php } ?>
                        </table>

                    </div>

                    <div class="col s6">
                        <h4>list of discounted products</h4>

                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Add to Discount</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($getProducts as $getProduct) {
                                    echo "<tr>";
                                    echo "<td>" . $getProduct['productID'] . "</td>";
                                    echo "<td>" . $getProduct['name'] . "</td>";
                                    echo "<td>" . $getProduct['color'] . "</td>";
                                    echo "<td>" . $getProduct['price'] . "</td>";
                                    echo "<td>" . $getProduct['quantity'] . "</td>";
                                    echo '<td><a href="addDiscoutToProductView.php?action=add&ID=' . $getProduct['productID'] . '" class="waves-effect waves-light btn red")">Add</a></td>';
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </form>
        </div>
    </div>

</body>