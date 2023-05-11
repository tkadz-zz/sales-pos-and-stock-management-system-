<?php
class Usercontr extends Model{

    public function dateToDay($mydate)
    {
        return parent::dateToDay($mydate);
    }

    public function updateStockDbQuantity($role, $itemID, $stockDbQuantity)
    {
        parent::updateStockDbQuantity($role, $itemID, $stockDbQuantity);
    }

    public function udateProductStockTake($pid, $uid, $physicalQuantities)
    {
        parent::udateProductStockTake($pid,$uid, $physicalQuantities);
    }

    public function newStockTake($userID){
        parent::newStockTake($userID);
    }

    public function GetRatesByCurrency($currency){
        parent::GetRatesByCurrency($currency);
    }

    public function updateRates($rate, $currency){
        parent::updateRates($rate, $currency);
    }

    public function manualAddSale($currency, $quantity, $itemID, $role){
        parent::manualAddSale($currency, $quantity, $itemID, $role);
    }

    public function delCategory($categID){
        parent::delCategory($categID);
    }

    public function addCategory($name){
        parent::addCategory($name);
    }

    public function cashPay($currency, $paid, $total, $transID, $role){
        parent::cashPay($currency, $paid, $total, $transID, $role);
    }

    public function ecocashPay($phone, $paid, $total, $transID, $role){
        parent::ecocashPay($phone, $paid, $total, $transID, $role);
    }

    public function cardPay($cardNumber, $paid, $total, $transID, $role)
    {
        parent::cardPay($cardNumber, $paid, $total, $transID, $role);
    }

    public function delCart($itemID, $role){
        parent::delCart($itemID, $role);
    }

    public function addcart($itemID, $transID, $price, $quantity, $role){
        parent::addcart($itemID, $transID, $price, $quantity,$role);
    }

    public function newTransaction($role){
        parent::newTransaction($role);
    }

    public function newDay(){
        parent::newDay();
    }

    public function addStock($name, $barCode, $buyingPrice, $sellingPrice, $quantities, $category){
        parent::addStock($name, $barCode, $buyingPrice, $sellingPrice, $quantities, $category);
    }

    public function delStock($itemID){
        parent::delStock($itemID);
    }

    public function updateStock($role, $name, $category, $barCode, $buyingPrice, $sellingPrice, $quantities, $itemID){
        parent::updateStock($role, $name, $category, $barCode, $buyingPrice, $sellingPrice, $quantities, $itemID);
    }

}
