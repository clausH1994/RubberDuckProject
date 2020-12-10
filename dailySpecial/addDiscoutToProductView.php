<?php
require_once("DailySpecialController.php");

require("../connection/session.php");

$session = new Session();

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
    if (isset($_GET['code'])) {
        $code = $_GET['code'];
    }

    //start the switch/case
    switch ($_GET["action"]) {
            //adding items to cart
        case "add":

            $dailyCon->addtoDiscountProduct($productID, $code);

            $adminId =  $_SESSION['admin_id'];
            $admin = $_SESSION['admin'];

            $_SESSION = $dailyCon->productArray;


            $_SESSION['admin_id'] = $adminId;
            $_SESSION['admin'] = $admin;
            break;
            //Remove item from cart
        case "remove":
            $dailyCon->removeDiscountProduct($code);

            $adminId =  $_SESSION['admin_id'];
            $admin = $_SESSION['admin'];

            $_SESSION = $dailyCon->productArray;

            $_SESSION['admin_id'] = $adminId;
            $_SESSION['admin'] = $admin;
            break;
        case "empty":
            unset($_SESSION["discountProducts"]);
            break;
    }
}

if (isset($_POST['submit'])) { // Form has been submitted.
    $redirect = new Redirector("../news/newsCreateView.php");
}

if (isset($_POST['cancel'])) { // Form has been submitted.
    unset($_SESSION["discountProducts"]);
    $redirect = new Redirector("../news/newsCreateView.php");
}

require_once("../admin/adminHeader.php");

?>

<body>
    <div class="container">
        <div class="row" style="margin-top:40px;">


            <form method="post">
                <div class="row">
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
                                            //var_dump($getDiscountProduct);
                                            echo "<tr>";
                                            echo "<td>" . $getDiscountProduct['productID'] . "</td>";
                                            echo "<td>" . $getDiscountProduct['name'] . "</td>";
                                            echo "<td>" . $getDiscountProduct['price'] . "</td>";
                                            echo "<td>" . $getDiscountProduct['quantity'] . "</td>";
                                            echo '<td><a href="addDiscoutToProductView.php?action=remove&code=' . $getDiscountProduct['code'] . '" class=" btn red" onclick="return confirm(\'Remove! are you sure?\')">Remove</a></td>';
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                <?php } ?>
                            </table>

                        </div>

                        <div class="col s6">
                            <h4>list of products</h4>

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
                                        echo "<tr>" .
                                            "<td>" . $getProduct['ID'] . "</td>" .
                                            "<td>" . $getProduct['name'] . "</td>" .
                                            "<td>" . $getProduct['color'] . "</td>" .
                                            "<td>" . $getProduct['price'] . "</td>" .
                                            "<td>" . $getProduct['quantity'] . "</td>" .
                                            '<td><a href="addDiscoutToProductView.php?action=add&ID=' . $getProduct['ID'] . '&code=' . $getProduct['code'] . '" class="waves-effect waves-light btn ")">Add</a></td>';
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light" type="submit" name="submit">add list</button>
                    <button class="btn red" type="submit" name="cancel">cancel</button>
                </div>
            </form>
        </div>
    </div>

</body>