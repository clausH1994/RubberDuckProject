<?php
require_once("newsDAO.php");
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

    public function deleteViewData()
    {
        $newsDAO = new NewsDAO();
        $row = $newsDAO->NewsAndSpecialDataDB();

        for ($i = 0; $i < 1; $i++) {
            echo
                "<h3>" . $row[0]['title'] .  "&nbsp;".
                 $row[0]['description']  . "&nbsp;" .
                 $row[0]['date'] . "</h3>";
        }

        foreach ($row as $row) {

            echo
                "<tr>" .
                    "<td>" . $row['dailyID'] . "</td>" .
                    "<td>" . $row['discount'] . "</td>" .
                    "<td>" . $row['productID'] . "</td>" .
                    "</tr>";
        }
    }

    public function deleteNewsAndrelevantRelations($newsID)
    {
        $newsDAO = new NewsDAO();
        $newsDAO->deleteNewsAndrelevantRelationsDB($newsID);
    }


    public function manangeCreate($title, $desc, $date, $disconunt, $listOfproducts)
    {
        $newsID = $this->createNews($title, $desc, $date);


        if ($disconunt != null || $disconunt != "") {
            require_once("../dailySpecial/DailySpecialController.php");
            require_once("../SpecialNews/SpecialNewsController.php");
            require_once("../offer/OfferController.php");

            $dailySpecialDAO = new DailySpecialDAO();
            $dailyID = $dailySpecialDAO->createDailySpecialDB($disconunt);

            $specialNews = new SpecialNewsController();
            $specialNews->createSpecialNews($dailyID, $newsID);

            $offer = new OfferController();
            $offer->createOffer($listOfproducts, $dailyID);

            $redirect = new Redirector("newsOverView.php");
        }
    }

    private function templateNews($row)
    {
        require("../SpecialNews/SpecialNewsController.php");
        $specialNews = new SpecialNewsController();

        require("../dailySpecial/DailySpecialController.php");
        $dailyCon = new DailySpecialController();

        $i = 0;

        foreach ($row as $row) {

            $specials = $specialNews->getSpecialNewsByNewsId($row->newsID);


            echo "<tr>";
            echo "<td>" . $row->title . "</td>";
            echo "<td>" . $row->description . "</td>";
            echo "<td>" . $row->date . "</td>";
            echo "<td>";
            if ($specials != null) {
                foreach ($specials as $special) {



                    $dailyS = $dailyCon->readdailySpecialByID($special[0]);

                    $dailyIndex = $dailyS[0][1];
                    echo $dailyIndex;

                    $amount = count($dailyS);

                    if ($i <= $amount) {
                        echo "&nbsp;" . "%";
                        echo "<br>";
                        $i++;
                    }
                }
                $i = 0;
            } else {
                $dailyIndex = "";
            }
            echo "</td>";
            echo '<td><a href="newsEditView.php?ID=' . $row->newsID . '" class="waves-effect waves-light btn" ">Edit</a></td>';
            echo '<td><a href="newsDeleteView.php?ID=' . $row->newsID . '" class="waves-effect waves-light btn red">Delete</a></td>';
            echo "</tr>";
        }
    }
}
