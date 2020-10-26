<?php require_once "dbcon.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM customers");
$query->execute();
$getProducts = $query->fetchAll();
//var_dump($getProducts);
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
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($getProducts as $getProduct) {
                    echo "<tr>";
                    echo "<td>". $getProduct['ProductID']."</td>";
                    echo "<td>". $getProduct['name']."</td>";
                    echo "<td>". $getProduct['category']."</td>";
                    echo "<td>". $getProduct['Color']."</td>";
                    echo "<td>". $getProduct['Price']."</td>";
                    echo "<td>". $getProduct['Image']."</td>";
                    echo "<td>";
                    echo "</td>";
                    echo '<td><a href="editEntry.php?ID='.$getProduct['ID'].'" class="waves-effect waves-light btn" ">Edit</a></td>';
                    echo '<td><a href="deleteEntry.php?ID='.$getProduct['ID'].'" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h3>Add new user to DB!</h3>

        <form class="col s12" name="contact" method="post" action="addEntry.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="Name" name="Name" type="text" class="validate" required="" aria-required="true">
                    <label for="Name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="Category" name="Category" type="text" class="validate" required="" aria-required="true">
                    <label for="Category">category</label>
                </div>
                <div class="input-field col s6">
                    <input id="Color" name="Color" type="text" class="validate" required="" aria-required="true">
                    <label for="Color">Color</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="Price" name="Price" type="Price" class="validate" required="" aria-required="true">
                    <label for="Price">Price</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="Image" name="Image" type="Image" class="validate" required="" aria-required="true">
                    <label for="Image">Image Url</label>
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