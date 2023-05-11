<?php
include("../pageIncludes/autoloader.inc.php");


if(isset($_GET['action']) AND $_GET['action'] == 'newStockTake'){
    //New Stock Take
    $userContr = new Usercontr();
    $userContr->newStockTake($_SESSION['id']);
}

if(isset($_GET['action']) AND $_GET['action'] == 'newTransaction') {
    try {
        $n = new Usercontr();
        $n->newTransaction($_SESSION['role']);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}

?>