<?php
include("../pageIncludes/autoloader.inc.php");


if(isset($_POST['btn_manual_add_Stock'])){
    $quantity = $_POST['quantity'];
    $currency = $_POST['currency'];
    $itemID = $_POST['itemID'];
    try {
        $n = new Usercontr();
        $n->manualAddSale($currency, $quantity, $itemID, $_SESSION['role']);
    }catch (TypeError $e){
        echo "ERROR: " . $e->getMessage();
    }
}


if(isset($_POST['btn_add_category'])){
    $categoryName = $_POST['name'];
    try {
        $n = new Usercontr();
        $n->addCategory($categoryName);
    }catch (TypeError $e){
        echo "ERROR: " . $e->getMessage();
    }
}

if(isset($_POST['cashPay'])){

    $transID = $_SESSION['transactionID'];
    $total = $_POST['paid'];
    $paid = $total;
    $currency = $_POST['currency'];
    $change = $paid - $total;
    $left = $total - $paid;


        try {
            $s = new Usercontr();
            $s->cashPay($currency, $paid, $total, $transID, $_SESSION['role']);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }

}


if(isset($_POST['ecocashPay'])) {

    $transID = $_SESSION['transactionID'];
    $phone = $_POST['phone'];
    $paid = $_POST['paid'];
    $total = $_POST['paid'];
    $change = $paid - $total;
    try {
        $s = new Usercontr();
        $s->ecocashPay($phone, $paid, $total, $transID, $_SESSION['role']);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}

if (isset($_POST['cardPay'])){

    $transID = $_SESSION['transactionID'];
    $cardNumber = $_POST['cardNumber'];
    //$cardExp = $_POST['cardExp'];
    //$cardCvv = $_POST['cardCvv'];
    $paid = $_POST['paid'];
    $total = $_POST['paid'];
    $change = $paid - $total;

    try {
        $s = new Usercontr();
        $s->cardPay($cardNumber, $paid, $total, $transID, $_SESSION['role']);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}





if(isset($_POST['btn_add_Stock'])){

    $name = strtoupper($_POST["name"]);
    $barCode = $_POST["barCode"];
    $buyingPrice = $_POST["buyingPrice"];
    $sellingPrice = $_POST["sellingPrice"];
    $quantities = $_POST["quantity"];
    $category = $_POST['category'];
    try {
        $sign_up_now = new Usercontr();
        $sign_up_now->addStock($name, $barCode, $buyingPrice, $sellingPrice, $quantities, $category);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}

if(isset($_POST['btn_addToCart'])) {

    $itemID = $_POST['itemID'];
    $transID = $_SESSION['transactionID'];
    $eachItemPrice = $_POST['price'];
    $quantity = $_POST['quantity'];

    $price = $quantity * $eachItemPrice;
    try {
        $s = new Usercontr();
        $s->addcart($itemID,$transID, $price, $quantity, $_SESSION['role']);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }

}

?>