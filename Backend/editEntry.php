<?php require_once "../connection/dbcon.php";
require("../admin/adminHeader.php");
if (isset($_GET['ID'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <?php
    $entryID = htmlspecialchars($_GET['ID']);
    $dbCon = dbCon();
    $query = $dbCon->prepare("SELECT * FROM Product WHERE ID=$entryID");
    $query->execute();
    $getProducts = $query->fetchAll();
    ?>

    <body>

        <div class="container">
            <h3>Editing product "<?php echo $getProducts[0][1]; ?>"</h3>
            <form class="col s12" name="contact" method="post" action="updateEntry.php">
             '  <div class="row">
                    <div class="input-field col s12">
                        <input id="Code" name="Code" type="text" value="<?php echo $getProducts[0]['code']; ?>" class="validate" required="" aria-required="true">
                        <label for="Code">Code</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="Name" name="Name" type="text" value="<?php echo $getProducts[0]['name']; ?>" class="validate" required="" aria-required="true">
                        <label for="Name">Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="Color" name="Color" type="text" value="<?php echo $getProducts[0]['color']; ?>" class="validate" required="" aria-required="true">
                        <label for="Color">Color</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="Price" name="Price" type="text" value="<?php echo $getProducts[0]['price']; ?>" class="validate" required="" aria-required="true">
                        <label for="Price">Price</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="Image" name="Image" type="text" value="<?php echo $getProducts[0]['image']; ?>" class="validate" required="" aria-required="true">
                        <label for="Image">image location</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="Quantity" name="Quantity" type="text" value="<?php echo $getProducts[0]['quantity']; ?>" class="validate" required="" aria-required="true">
                        <label for="Quantity">Quantity</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="description" id="description" class="materialize-textarea" required="" aria-required="true"><?php echo $getProducts[0]['desc']; ?></textarea>
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
<?php } else {
    header("Location: index.php?status=0");
} ?>