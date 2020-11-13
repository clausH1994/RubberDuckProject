<?php
require_once("NewsController.php");


if (isset($_GET['ID'])) {
    $newsID = $_GET['ID'];
    $newsCon = new NewsController();
    $newsCon->deleteNews($newsID);
}