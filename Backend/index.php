<?php require_once "../connection/dbcon.php";
require("../admin/adminHeader.php");
?>

<?php
$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM Product");
$query->execute();
$getProducts = $query->fetchAll();

$coloQuery = $dbCon->prepare("SELECT * FROM Color");
$coloQuery->execute();
$getColors = $coloQuery->fetchAll();

?>

<body>

    <div class="container">

        <h2>Product management</h2>
        <?php
        if (isset($_GET['status'])) {
            if ($_GET['status'] == "deleted") {
                echo "The entry " . $_GET['ID'] . " has been successfully deleted!";
                echo "<script>M.toast({html: 'Deleted!'})</script>";
            } elseif ($_GET['status'] == "updated") {
                echo "The entry " . $_GET['ID'] . " has been successfully Updated!";
                echo "<script>M.toast({html: 'Updated!'})</script>";
            } elseif ($_GET['status'] == "added") {
                echo "The new entry has been successfully added!";
                echo "<script>M.toast({html: 'Added!'})</script>";
            } elseif ($_GET['status'] == 0) {
                echo "Forbidden access - redirected to home!";
                echo "<script>M.toast({html: 'Access denied!'})</script>";
            }
        }
        ?>
        <div class="row">
            <div class="row">
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Price</th>
                            <th>Image URL</th>
                            <th>Quantity</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        foreach ($getProducts as $getProduct) {
                            echo "<tr>
                            <td>" . $getProduct['ID'] . "</td>
                            <td>" . $getProduct['code'] . "</td>
                            <td>" . $getProduct['name'] . "</td>
                            <td>" . $getProduct['color'] . "</td>
                            <td>" . $getProduct['price'] . "</td>
                            <td>" . $getProduct['image'] . "</td> 
                            <td>" . $getProduct['quantity'] . "</td>";
                            echo '<td><a href="editEntry.php?ID=' . $getProduct['ID'] . '" class="waves-effect waves-light btn" ">Edit</a></td>';
                            echo '<td><a href="deleteEntry.php?ID=' . $getProduct['ID'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <hr>
            <h3>Add new product to DB!</h3>



            <form class="col s12" name="contact" method="post" action="addEntry.php">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="Code" name="Code" type="text" class="validate" required="" aria-required="true">
                        <label for="Code">Code</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="Name" name="Name" type="text" class="validate" required="" aria-required="true">
                        <label for="Name">Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <p>Color:</p>
                        <select name="Color" class="browser-default">
                            <?php
                            foreach ($getColors as $getColor) {
                                echo "<option value='" . $getColor['colorID'] . "'>" . $getColor['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="Price" name="Price" type="text" class="validate" required="" aria-required="true">
                        <label for="Price">Price</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <p>Image Url:</p>
                        <input id="Image" name="Image" type="file" class="validate" required="" aria-required="true">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="Quantity" name="Quantity" type="text" class="validate" required="" aria-required="true">
                        <label for="Quantity">Quantity</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="description" id="description" class="materialize-textarea" required="" aria-required="true"></textarea>
                        <label for="description">Description</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="submit">Add
                </button>
            </form>
        </div>
    </div>
</body>

</html>