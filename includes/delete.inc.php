<?php
include("../pageIncludes/autoloader.inc.php");

if(isset($_GET['delCategory'])){
    $categID =$_GET['categID'];
    try {
        $n = new Usercontr();
        $n->delCategory($categID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}

if(isset($_GET['delStock'])){
    $itemID = $_GET["delItem"];
    try {
        $n = new Usercontr();
        $n->delStock($itemID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}

if(isset($_GET['delCart'])){
    $itemID = $_GET["itemID"];
    try {
        $n = new Usercontr();
        $n->delCart($itemID, $_SESSION['role']);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}

?>