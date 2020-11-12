<?php
class CartController
{
    public $itemArray;
    public $newItemArray;
    public function existingCart($existingItems)
    {
        if (!empty($existingItems)) {
            $this->itemArray["cartItem"] = $existingItems;
        }
    }
    public function cartAdd($productID, $quantity)
    {
        $db_handle = new DBController();
        if (!empty($quantity)) {
            $productByID = $db_handle->runQuery("SELECT * FROM product WHERE productID='" . $productID . "'");
            $this->newItemArray = array($productByID[0]["productID"] => array(
                'name' => $productByID[0]["name"],
                'productID' => $productByID[0]["productID"],
                'quantity' => $_POST["quantity"],
                'price' => $productByID[0]["price"]));

            if (!empty($this->itemArray["cartItem"])) {
                if (in_array($productByID[0]["productID"], array_keys($this->itemArray["cartItem"]))) {
                    foreach ($this->itemArray["cartItem"] as $k => $v) {
                        if ($productByID[0]["productID"] == $k) {
                            if (empty($this->itemArray["cartItem"][$k]["quantity"])) {
                                $this->itemArray["cartItem"][$k]["quantity"] = 0;
                            }
                            $this->itemArray["cartItem"][$k]["quantity"] += $_POST["quantity"];
                        }
                    }
                } else {
                    $this->itemArray["cartItem"] = array_merge($this->itemArray["cartItem"], $this->newItemArray);
                }
            } else {
                $this->itemArray["cartItem"] = $this->newItemArray;
            }
        }
    }

    public function cartRemove($productID){
    //Remove item from cart
        if (!empty($this->itemArray["cartItem"])) {
            foreach ($this->itemArray["cartItem"] as $k => $v) {
                if ($productID == $k)
                    unset($this->itemArray["cartItem"][$k]);
                if (empty($this->itemArray["cartItem"]))
                    unset($this->itemArray["cartItem"]);
            }
        }
    }
    public function __destruct() {
        //$_SESSION["cart_item"] = $this->itemArray;
    }
}