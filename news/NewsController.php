<?php
require_once("NewsDAO.php");
spl_autoload_register(function ($class) {
    include "../connection/" . $class . ".php";
});

class NewsController
{
    public function readNews()
    {
        $newsDAO = new NewsDAO();
        $news = $newsDAO->readNewsDB();

        $this->templateNews($news);
    }

    public function readNewsByID($newsID)
    {
        $newsDAO = new NewsDAO();
        $result = $newsDAO->readNewsByIdDB($newsID);

        return $result;
    }

    public function createNews($title, $desc, $date)
    {
        $newsDAO = new NewsDAO();
        $newsID = $newsDAO->createNewsDB($title, $desc, $date);
        return $newsID;
    }

    public function editNews($newsID, $title, $desc, $date)
    {
        $newsDAO = new NewsDAO();
        $newsDAO->updateNewsDB($newsID, $title, $desc, $date);
        $redirect = new Redirector("newsOverView.php");
    }

    public function deleteNews($newsID)
    {
        $newsDAO = new NewsDAO();
        $newsDAO->deleteNewsDB($newsID);
        $redirect = new Redirector("newsOverView.php");
    }

    public function manangeCreate($title, $desc, $date, $disconunt)
    {
        $newsID = $this->createNews($title, $desc, $date);
        

        if ($disconunt != null || $disconunt != "") {
            require("../dailySpecial/DailySpecialController.php");
            require("../SpecialNews/SpecialNewsController.php");

            $dailySpecialDAO = new DailySpecialDAO();
            $dailyID = $dailySpecialDAO->createDailySpecialDB($disconunt);
            
            $specialNews = new SpecialNewsController();
            $specialNews->createSpecialNews($dailyID, $newsID);
            $redirect = new Redirector("newsOverView.php");
        }
    }

    private function templateNews($row)
    {
        foreach ($row as $row) {

            
            
            echo "<tr>";
            echo "<td>" . $row->title . "</td>";
            echo "<td>" . $row->description . "</td>";
            echo "<td>" . $row->date . "</td>";
            echo "<td>" . "" . "%" . "</td>";
            echo '<td><a href="newsEditView.php?ID=' . $row->newsID . '" class="waves-effect waves-light btn" ">Edit</a></td>';
            echo '<td><a href="newsDelete.php?ID=' . $row->newsID . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
            echo "</tr>";
        }
    }
}
