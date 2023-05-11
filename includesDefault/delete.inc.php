<?php
include("../pageIncludes/autoloader.inc.php");

if(isset($_GET['delUser'])) {
    $userID = $_GET['userID'];
    try {
        $n = new DefaultContr();
        $n->delUser($userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}

if(isset($_GET['delAvatar'])){
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];

    try {
        $s = new DefaultContr();
        $s->delAvatar($role, $id);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();

    }
}


?>