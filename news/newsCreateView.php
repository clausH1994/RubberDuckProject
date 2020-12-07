<?php
require_once("../admin/adminHeader.php");
require_once("NewsController.php");
require_once("../dailySpecial/DailySpecialController.php");

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
        case "remove":

            $dailyCon->removeDiscountProduct($productID);

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
    if (!empty($_POST['token'])) {
        if (hash_equals($_SESSION['token'], $_POST['token'])) {
            unset($_SESSION['token']);
            $newsCon = new NewsController();
            $newsCon->manangeCreate($_POST["title"], $_POST["desc"], $_POST["date"], $_POST["discount"], $_SESSION["discountProducts"]);
        } else {
            die('CSRF VALIDATION FAILED');
        }
    } else {
        die('CSRF TOKEN NOT FOUND. ABORT');
    }
}

?>


<body>
    <div class="container">
        <div class="row" style="margin-top:40px;">

            <h2>Create News Post</h2>
            <form method="post">

                <div class="col s12">
                    <div class="col s6">

                        <div class="input-field col s12">
                            Title:
                            <input type="text" name="title" value="" required />
                        </div>
                        <div class="input-field col s12">
                            Desciption:
                            <textarea id="descArea" class="materialize-textarea" name="desc" value="" required></textarea>
                        </div>
                        <div class="input-field col s12">
                            Date:
                            <input type="date" name="date" maxlength="30" value="" required />
                        </div>
                        <div class="input-field col s12">
                            Discount:
                            <input type="number" name="discount" maxlength="30" value="" />
                        </div>
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light" type="submit" name="submit" value="Create">Create News</button>
                            <a href="newsOverView.php" class="waves-effect waves-light btn red">Cancel</a>
                        </div>
                    </div>

                    <div class="col s6">
                        <a class="btn" href="../dailySpecial/addDiscoutToProductView.php">Add Product to Discount</a>
                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <?php if (isset($_SESSION["discountProducts"])) { ?>
                                <tbody>
                                    <?php
                                    foreach ($_SESSION["discountProducts"] as $getProduct) {
                                        echo "<tr>"
                                            . "<td>" . $getProduct['productID'] . "</td>" .
                                            "<td>" . $getProduct['name'] . "</td>" .
                                            "<td>" . $getProduct['price'] . "</td>" .
                                            "<td>" . $getProduct['quantity'] . "</td>" .
                                            '<td><a href="newsCreateView.php?action=remove&ID=' . $getProduct['productID'] . '" class="btn red" onclick="return confirm(\'Remove! are you sure?\')">Remove</a></td>';
                                        "</tr>";
                                    }
                                    ?>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <input type="hidden" name="token" value="<?php echo $token; ?>" />
            </form>
        </div>
    </div>

</body>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, options);
    });
</script>