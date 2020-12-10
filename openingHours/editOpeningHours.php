<?php require_once "../connection/dbcon.php";
require("../admin/adminHeader.php");
if (isset($_GET['ID'])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Edit opening hours</title>
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </head>
    <?php
    $openinghourID = $_GET['ID'];
    $dbCon = dbCon();
    $query = $dbCon->prepare("SELECT * FROM OpeningHours WHERE openinghoursID=$openinghourID");
    $query->execute();
    $getData = $query->fetchAll();

    ?>

    <body>

        <div class="container">
            <h3>Editing data "<?php echo $getData[0][1]; ?>"</h3>
            <form class="col s12" name="opening hours" method="post" action="editOpeningHoursData.php">
                <div class="row">
                    <div class="input-field col s12">
                        <input id="weekday" name="day" type="text" value="<?php echo $getData[0][1]; ?>" class="validate" required="" aria-required="true">
                        <label for="day">Weekday</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="startTime" name="startTime" type="text" value="<?php echo $getData[0][2]; ?>" class="validate" required="" aria-required="true">
                        <label for="startTime">Opening</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="endtime" name="endtime" type="text" value="<?php echo $getData[0][3]; ?>" class="validate" required="" aria-required="true">
                        <label for="enttime">closing</label>
                    </div>
                </div>
                <input type="hidden" name="openinghoursID" value="<?php echo $openinghourID; ?>">
                <input type="hidden" name="token" value="<?php echo $token; ?>" />
                <button class="btn waves-effect waves-light" type="submit" name="submit">Update
                </button>
                <button class="btn waves-effect waves-light" type="submit" name="cancel">cancel
                </button>
            </form>
        </div>
        </div>
    </body>

    </html>
<?php } else {
    header("Location: openingHours.php");
} ?>



<?php
require_once "../connection/Redirector.php";
if (isset($_POST['cancel'])) {
    $redirector = new Redirector("aboutUs.php");
}
