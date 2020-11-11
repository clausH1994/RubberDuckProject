<?php
require_once("SpecialNewsDAO.php");


class SpecialNewsController
{
    public function createSpecialNews($dailyID, $newsID)
    {
        $specialNewsDAO = new SpecialNewsDAO();
        $specialNewsDAO->createSpecialNewsDB($dailyID, $newsID);
    }

    public function getDailyByNewsId($newsID)
    {
        $specialNewsDAO = new SpecialNewsDAO();
        $specialNews = $specialNewsDAO->readSpecialNewsByNewsDB($newsID);

        foreach ($specialNews as $specail) {
            # code here
        }

      
    }

    
}
