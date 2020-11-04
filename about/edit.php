<?php require_once "../connection/dbcon.php";
if (!isset($_GET['ID'])) {
    header("Location: aboutUs.php");}else{ 
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
$companyID = $_GET['ID'];
$dbCon = dbCon();
$query = $dbCon->prepare("SELECT * FROM company WHERE companyID=$companyID");
$query->execute();
$getData = $query->fetchAll();
//var_dump($getData);

?>
<body>

<div class="container">
        <h3>Editing data "<?php echo $getData[0][1]; ?>"</h3>
        <form class="col s12" name="companyInfo" method="post" action="editData.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" name="name" type="text" value="<?php echo $getData[0][1]; ?>" class="validate" required="" aria-required="true">
                    <label for="name">Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="address" name="address" type="text"value="<?php echo $getData[0][2]; ?>" class="validate" required="" aria-required="true">
                    <label for="address">Address</label>
                </div>
                <div class="input-field col s6">
                    <input id="postalID" name="postalID" type="text"value="<?php echo $getData[0][3]; ?>" class="validate" required="" aria-required="true">
                    <label for="postalID">Postalcode</label>
                </div>
            </div>
            <div class="row">
            <div class="input-field col s12">
                    <input id="phone" name="phone" type="text"value="<?php echo $getData[0][4]; ?>" class="validate" required="" aria-required="true">
                    <label for="phone">Phone</label>
                </div>
                <div class="input-field col s12">
                    <input id="email" name="email" type="email"value="<?php echo $getData[0][5]; ?>" class="validate" required="" aria-required="true">
                    <label for="email">E-Mail</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <textarea name="description" id="description" class="materialize-textarea" required="" aria-required="true"><?php echo $getData[0][6]; ?></textarea>
                    <label for="description">Description</label>
                </div>
            </div>
            <input type="hidden" name="companyID" value="<?php echo $companyID; ?>">
            <button class="btn waves-effect waves-light" type="submit" name="submit">Update
            </button>
            <button class="btn waves-effect waves-light" type="submit" name="cancel">cancel
            </button>
        </form>
    </div>
</div>
</body>
</html>
<?php    
}?>

<?php
require_once "../connection/Redirector.php";
if (isset($_POST ['cancel'])) {
    $redirector = new Redirector("aboutUs.php");
}