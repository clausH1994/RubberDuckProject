<?php
require_once("OfferDAO.php");

class OfferController
{
    public function createOffer($listOfProduct, $dailyID)
    {
        $offerDAO = new OfferDAO();

        foreach ($listOfProduct as $productID) {
            //$offerDAO->createOfferDB($productID, $dailyID);
          
        }
    }
}
