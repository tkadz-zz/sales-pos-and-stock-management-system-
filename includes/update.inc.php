<?php
include("../pageIncludes/autoloader.inc.php");
$n = new Usercontr();


if(isset($_POST['btn_updateProductStockTake'])){
    $pid = $_POST['pid'];
    $uid = $_POST['uid'];
    $physicalQuantities = $_POST['PhysicalQuantities'];
    try {
       $n->udateProductStockTake($pid, $uid, $physicalQuantities);
    }catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}

if(isset($_POST['btn_update_rate'])){
    $currency = $_POST['currency'];
    $rate = $_POST['rate'];
    try {
        $n->updateRates($rate, $currency);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}

if(isset($_POST['btn_update_stockDbQuantity'])){
    $role = $_SESSION['role'];
    $itemID = $_POST["itemID"];
    $stockDbQuantity = $_POST['stockDbQuantity'];
    try {
        $n->updateStockDbQuantity($role, $itemID, $stockDbQuantity);
    }catch (TypeError $e){
        echo "Error" . $e->getMessage();
    }
}

if(isset($_POST['btn_update_Stock'])){

    $itemID = $_POST["itemID"];
    $name = $_POST["name"];
    $barCode = $_POST["barCode"];
    $buyingPrice = $_POST["buyingPrice"];
    $sellingPrice = $_POST["sellingPrice"];
    $quantities = $_POST["quantity"];
    $category = $_POST['category'];
    try {
        $n->updateStock($_SESSION['role'], $name, $category, $barCode, $buyingPrice, $sellingPrice, $quantities, $itemID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}

if(isset($_GET['newDay'])){
    try {
        $n->newDay();
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}


?>