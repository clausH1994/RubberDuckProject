<?php
require_once("OfferDAO.php");

class OfferController
{
    public function createOffer($listOfProduct, $dailyID)
    {
        $offerDAO = new OfferDAO();

        foreach ($listOfProduct as $product) {
            $productID = $product['productID'];
            
            $offerDAO->createOfferDB($productID, $dailyID);
        }
    }

    public function deleteOffer($offerID)
    {
        $offerDAO = new OfferDAO();
        $offerDAO->deleteOfferDB($offerID);
    }
}
