<?php require_once("../admin/adminHeader.php");
require_once("NewsController.php");
unset($_SESSION["discountProducts"]);
?>

<body>
    <div class="container">
        <div class="row">
            <div class="row">
                <table class="highlight">
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>Desciption</th>
                            <th>Date</th>
                            <th>Discount(%)</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $newsCon = new NewsController();
                        $newsCon->readNews();
                        ?>
                    </tbody>
                </table>
            </div>
            <a href="newsCreateView.php" class="waves-effect waves-light btn" >Add News</a>
        </div>
    </div>

</body>