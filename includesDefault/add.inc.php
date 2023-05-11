<?php
include("../pageIncludes/autoloader.inc.php");

if(isset($_POST['btn_addUser'])){

    $userRole= $_POST['userType'];

    $nameRaw = $_POST["name"];
    $name = strtoupper($nameRaw);

    $surnameRaw = $_POST["surname"];
    $surname = strtoupper($surnameRaw);

    $reNumberRaw = $_POST["loginID"];
    $loginID = strtoupper($reNumberRaw);

    if(strlen($loginID) < 1){
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'LoginID is empty';
        echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
    } elseif(strlen($name) < 1){
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'Name is empty';
        echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
    } elseif(strlen($surname) < 1){
        $_SESSION['type'] = 'd';
        $_SESSION['err'] = 'Surname is empty';
        echo "<script type='text/javascript'>;
             window.location='../signup.php';
            </script>";
    } else{
        $activeStatus = 1;
        try {
            $sign_up_now = new DefaultContr();
            $sign_up_now->addUser($name, $surname, $loginID, $userRole, $activeStatus);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();

        }
    }
}


else{
    $_SESSION['type'] = 'i';
    $_SESSION['err'] = 'No Command Provided';
    echo "<script type='text/javascript'>;
             history.back(-1);
            </script>";
}


?>