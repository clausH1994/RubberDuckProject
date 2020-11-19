<?php
require_once("../admin/adminHeader.php");
require_once("NewsController.php");


?>


<body>
    <div class="container">
        <div class="row" style="margin-top:40px;">

            <h2>Create News Post</h2>
            <form method="post">¨

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
                                    <th>Color</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Delete</th>
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
                                    echo '<td><a href="' . $getProduct['productID'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Remove! are you sure?\')">remove</a></td>';
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


<?php
if (isset($_POST['submit'])) { // Form has been submitted.
    $newsCon = new NewsController();
    $newsCon->manangeCreate($_POST["title"], $_POST["desc"], $_POST["date"], $_POST["discount"]);
}

?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, options);
    });
</script>