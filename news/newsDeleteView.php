<?php
require_once("../admin/adminHeader.php");
require_once("NewsController.php");

$newsCon = new NewsController();




if (isset($_GET['ID'])) {
    $newsID = $_GET['ID'];
    if (!empty($_GET["action"])) {
        //start the switch/case
        switch ($_GET["action"]) {
            case "delete":
                $newsCon->deleteNewsAndrelevantRelations($newsID);
        }
    } else {


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
                    <a href="newsDeleteView.php?action=delete&ID=<?php echo $newsID ?>" class="waves-effect waves-light btn" onclick="return confirm('Delete! are you sure?')">Delete ALL THE DATA</a>
                    <a href="newsOverView.php" class="waves-effect waves-light btn red">Cancel</a>
                </div>
            </div>

        </body>




<?php }
}
