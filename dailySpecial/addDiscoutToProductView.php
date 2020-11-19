<?php
require_once("../admin/adminHeader.php");
require_once("DailySpecialController.php");


$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM Product");
$query->execute();
$getProducts = $query->fetchAll();



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
                                    <th>Color</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($getDiscountProducts as $getDiscountProduct) {
                                    echo "<tr>";
                                    echo "<td>" . $getDiscountProduct['productID'] . "</td>";
                                    echo "<td>" . $getDiscountProduct['name'] . "</td>";
                                    echo "<td>" . $getDiscountProduct['color'] . "</td>";
                                    echo "<td>" . $getDiscountProduct['price'] . "</td>";
                                    echo "<td>" . $getDiscountProduct['quantity'] . "</td>";
                                    echo '<td><a href="' . $getDiscountProduct['productID'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Remove! are you sure?\')">Remove</a></td>';
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
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
                                    echo '<td><a href=" addDiscoutToProductView.php?ID=' . $getProduct['productID'] . '" class="waves-effect waves-light btn red")">Add</a></td>';
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