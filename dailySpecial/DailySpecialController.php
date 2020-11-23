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
    
    public function addtoDiscountProduct($productID)
    {

        if (!empty($productID)) {

            $dbcon = dbCon();

            $query = "SELECT  * FROM Product WHERE productID= :productID";
            $handle = $dbcon->prepare($query);
            $handle->bindParam(':productID', $productID);

            $handle->execute();
            $productByID = $handle->fetchAll();

            $this->newProductArray = array($productByID[0]["productID"] => array(
                'name' => $productByID[0]["name"],
                'productID' => $productByID[0]["productID"],
                'quantity' => $productByID[0]["quantity"],
                'price' => $productByID[0]["price"]
            ));

            if (!empty($this->productArray["discountProducts"])) {
                if (in_array($productByID[0]["productID"], array_keys($this->productArray["discountProducts"]))) {

                    foreach ($this->productArray["discountProducts"] as $k => $v) {
                        if ($productByID[0]["productID"] == $k) {

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

    public function removeDiscountProduct($productID)
    {
        if (!empty($this->productArray["discountProducts"])) {
            foreach ($this->productArray["discountProducts"] as $k => $v) {
                if ($productID == $k)
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
