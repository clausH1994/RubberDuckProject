<?php require_once "../connection/dbcon.php";
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
$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM product WHERE productID=$entryID");
$query->execute();
$getProducts = $query->fetchAll();
?>
<body>

<div class="container">
        <h3>Editing user "<?php echo $getProducts[0][1]; ?>"</h3>
        <form class="col s12" name="contact" method="post" action="updateEntry.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="Name" name="Name" type="text" value="<?php echo $getProducts[0]['name']; ?>" class="validate" required="" aria-required="true">
                    <label for="Name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="Color" name="Color" type="text"value="<?php echo $getProducts[0]['color']; ?>" class="validate" required="" aria-required="true">
                    <label for="Color">Color</label>
                </div>
            </div>
            <div class="row">
            <div class="input-field col s12">
                    <input id="Price" name="Price" type="text"value="<?php echo $getProducts[0]['price']; ?>" class="validate" required="" aria-required="true">
                    <label for="Price">Price</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="Image" name="Image" type="text"value="<?php echo $getProducts[0]['image']; ?>" class="validate" required="" aria-required="true">
                    <label for="Image">image location</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="description" id="description" class="materialize-textarea" required="" aria-required="true"><?php echo $getProducts[0]['description']; ?></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <input type="hidden" name="entryID" value="<?php echo $entryID; ?>">
            <button class="btn waves-effect waves-light" type="submit" name="submit">Update
            </button>
        </form>
    </div>
</div>
</body>
</html>
<?php }else{    header("Location: index.php?status=0");
}?>
