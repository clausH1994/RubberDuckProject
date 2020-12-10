<?php
require("../connection/session.php");
require_once("NewsController.php");

$session = new Session();

$newsCon = new NewsController();

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

if (isset($_GET['ID'])) {
    $newsID = $_GET['ID'];
    if (!empty($_GET["action"])) {
        //start the switch/case
        switch ($_GET["action"]) {
            case "delete":
                if (!empty($_GET['token'])) {
                    if (hash_equals($_SESSION['token'], $_GET['token'])) {
                        unset($_SESSION['token']);
                        $newsCon->deleteNewsAndrelevantRelations($newsID);
                    } else {
                        die('CSRF VALIDATION FAILED');
                    }
                } else {
                    die('CSRF TOKEN NOT FOUND. ABORT');
                }
        }
    }else {

        require_once("../admin/adminHeader.php");

?>

        <body>
            <div class="container">
                <div class="row">
                    <div class="row">
                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th>dailyID</th>
                                    <th>discount(%)</th>
                                    <th>productID</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $newsCon->deleteViewData();
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <a href="newsDeleteView.php?action=delete&ID=<?php echo $newsID ?>&token=<?php echo $token ?>" class="waves-effect waves-light btn" onclick="return confirm('Delete! are you sure?')">Delete ALL THE DATA</a>
                    <a href="newsOverView.php" class="waves-effect waves-light btn red">Cancel</a>
                </div>
            </div>

        </body>




<?php }
}
