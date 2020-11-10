<?php
require_once("../admin/adminHeader.php");
require_once("NewsController.php");
?>


<body>
    <div class="container">
        <div class="row" style="margin-top:40px;">
            <div class="row">
                <h2>Create News Post</h2>
                <form action="" method="post">
                    Title:
                    <input type="text" name="title" value="" required />
                    Desciption:
                    <textarea id="descArea"  class="materialize-textarea" name="desc" value="" required></textarea>
                    Date:
                    <input type="date"  name="date" maxlength="30" value="" required />
                    <button class="btn waves-effect waves-light" type="submit" name="submit" value="Create">Create News</button>
                    <a href="newsOverView.php" class="waves-effect waves-light btn red">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>


<?php
if (isset($_POST['submit'])) { // Form has been submitted.
    $newsCon = new NewsController();
    $newsCon->createNews($_POST["title"], $_POST["desc"], $_POST["date"]);
}

?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems, options);
    });
</script>