<?php require_once "dbcon.php";
if (isset($_GET['ID'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit entry</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<?php
$entryID = $_GET['ID'];
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM customers WHERE ID=$entryID");
$query->execute();
$getProducts = $query->fetchAll();
?>
<body>

<div class="container">
        <h3>Editing user "<?php echo $getProducts[0][1]; ?>"</h3>
        <form class="col s12" name="contact" method="post" action="updateEntry.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="Name" name="Name" type="text" value="<?php echo $getProducts[0][1]; ?>" class="validate" required="" aria-required="true">
                    <label for="Name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="Category" name="Category" type="text"value="<?php echo $getProducts[0][2]; ?>" class="validate" required="" aria-required="true">
                    <label for="Category">Category</label>
                </div>
                <div class="input-field col s12">
                    <input id="Color" name="Color" type="text"value="<?php echo $getProducts[0][3]; ?>" class="validate" required="" aria-required="true">
                    <label for="Color">Color</label>
                </div>
            </div>
            <div class="input-field col s12">
                    <input id="Price" name="Price" type="text"value="<?php echo $getProducts[0][3]; ?>" class="validate" required="" aria-required="true">
                    <label for="Price">Price</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="Image" name="Image" type="Image"value="<?php echo $getProducts[0][4]; ?>" class="validate" required="" aria-required="true">
                    <label for="Image">image location</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="description" id="description" class="materialize-textarea" required="" aria-required="true"><?php echo $getProducts[0][6]; ?></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="submit">Update
            </button>
        </form>
    </div>
</div>
</body>
</html>
<?php }else{    header("Location: index.php?status=0");
}?>
