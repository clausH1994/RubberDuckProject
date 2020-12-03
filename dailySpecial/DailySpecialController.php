<?php
require_once("DailySpecialDAO.php");
require_once("../connection/dbcon.php");

class DailySpecialController
{
    public $message;
    public $productArray;
    public $newProductArray;

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

    public function deleteDailySpecial($dailyID)
    {
        $dailySpecialDAO = new DailySpecialDAO();
        $dailySpecialDAO->deleteDailySpecialDB($dailyID);
    }
    
    public function addtoDiscountProduct($productID, $code)
    {

        if (!empty($productID)) {

            $dbcon = dbCon();

            $query = "SELECT  * FROM Product WHERE code = :code";
            $handle = $dbcon->prepare($query);
            $handle->bindParam(':code', $code);

            $handle->execute();
            $productByCode = $handle->fetchAll();
            
            $this->newProductArray = array($productByCode[0]["code"] => array(
                'productID' => $productByCode[0]['ID'],
                'name' => $productByCode[0]["name"],
                'code' => $productByCode[0]["code"],
                'quantity' => $productByCode[0]["quantity"],
                'price' => $productByCode[0]["price"]
            ));

            if (!empty($this->productArray["discountProducts"])) {
                if (in_array($productByCode[0]["code"], array_keys($this->productArray["discountProducts"]))) {

                    foreach ($this->productArray["discountProducts"] as $k => $v) {
                        if ($productByCode[0]["code"] == $k) {

                            if (empty($this->itemArray["discountProducts"][$k])) {
                                $this->itemArray["discountProducts"][$k] = 0;
                            }
                        }
                    }
                } else {
                    $this->productArray["discountProducts"] = array_merge($this->productArray["discountProducts"], $this->newProductArray);
                }
            } else {
                $this->productArray["discountProducts"] = $this->newProductArray;
            }
        }
    }

    public function removeDiscountProduct($code)
    {
        if (!empty($this->productArray["discountProducts"])) {
            foreach ($this->productArray["discountProducts"] as $k => $v) {
                if ($code == $k)
                    unset($this->productArray["discountProducts"][$k]);
                if (empty($this->productArray["discountProducts"]))
                    unset($this->productArray["discountProducts"]);
            }
        }
    }

    public function existingDiscountProduct($existingProduct)
    {
        if (!empty($existingProduct)) {
            $this->productArray["discountProducts"] = $existingProduct;
        }
    }

    public function __destruct()
    {
        //$_SESSION["cart_item"] = $this->itemArray;
    }
}
