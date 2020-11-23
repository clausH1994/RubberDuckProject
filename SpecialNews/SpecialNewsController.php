<?php
require_once("SpecialNewsDAO.php");


class SpecialNewsController
{
    public function createSpecialNews($dailyID, $newsID)
    {
        $specialNewsDAO = new SpecialNewsDAO();
        $specialNewsDAO->createSpecialNewsDB($dailyID, $newsID);
    }

    public function getSpecialNewsByNewsId($newsID)
    {
        $specialNewsDAO = new SpecialNewsDAO();
        $specialNews = $specialNewsDAO->readSpecialNewsByNewsDB($newsID);

        return $specialNews;
    }

    public function deleteSpecialNewsWithNewsID($newsID)
    {
        $specialNewsDAO = new SpecialNewsDAO();
        $specialNewsDAO->deleteSpecialNewsWithNewsIDDB($newsID);
    }
}
