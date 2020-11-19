<?php
require_once("DailySpecialDAO.php");



class DailySpecialController
{

    

    /*  public function readDailySpecial()
    {
        $dailySpecialDAO = new DailySpecialDAO();
        $dailySpecial = $dailySpecialDAO->readDailySpecialDB();

        return $dailySpecial;
    } */

    public function readdailySpecialByID($dailyID)
    {
        $dailySpecialDAO = new DailySpecialDAO();
        $result = $dailySpecialDAO->readDailySpecialByIdDB($dailyID);

        return $result;
    }

    public function createDailySpecial($discount)
    {
        $dailySpecialDAO = new DailySpecialDAO();
        $dailyID = $dailySpecialDAO->createDailySpecialDB($discount);
        return $dailyID;
    }

    public function addtoDiscountProduct($discountProducts, $productID)
    {
       array_push($discountProducts, $productID);
       return $discountProducts;
    }
}
