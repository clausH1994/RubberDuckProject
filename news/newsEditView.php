<?php
spl_autoload_register(function ($class) {
    include "../connection/" . $class . ".php";
});

if (!isset($_GET['ID'])) {
    $redirector = new Redirector("newsOverView.php");
}
require_once("../admin/adminHeader.php");
require_once("NewsController.php");

$newsCon = new NewsController();
$news = $newsCon->readNewsById($_GET['ID']);
?>


<html>

<body>
    <div class="container">
        <div class="row" style="margin-top:40px;">
            <div class="row">
                <h2>Update News Post</h2>
                <form method="POST">
                    Title:
                    <input type="text" name="title" value="<?php echo $news[0][1]; ?>" required />
                    Desciption:
                    <textarea class="materialize-textarea" name="desc" required><?php echo $news[0][2]; ?></textarea>
                    Date:
                    <input type="date" name="date" maxlength="30" value="<?php echo $news[0][3]; ?>" required />
                    <br><br>
                    <button class="btn waves-effect waves-light" type="submit" name="submit">Update News</button>
                    <a href="newsOverView.php" class="waves-effect waves-light btn red">Cancel</a>
                </form>

            </div>
        </div>
    </div>
</body>

</html>


<?php


// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
    $newsCon->editNews($_GET['ID'], $_POST['title'], $_POST['desc'],  $_POST['date'],);
}
