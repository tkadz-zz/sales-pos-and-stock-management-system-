<?php
include("../pageIncludes/autoloader.inc.php");

if(isset($_POST['btn_signin'])) {
    //Main Signin from signin.php
    $loginID = $_POST["loginID"];
    $password = $_POST["password"];
    try {
        $login = new AuthenticationContr();
        $login->SigninUser($loginID, $password);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}


elseif (isset($_POST['setpassword_btn'])){
    //Set Password from Setpassword.php
    $loginID = $_SESSION['loginIDTemp'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    if (strlen($password) < 8 || strlen($confirmPassword) < 8){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Password is too short';
        echo "<script type='text/javascript'>;
             history.back(-1);
            </script>";
    }
    else {
        try {
            $login = new AuthenticationContr();
            $login->SigninUser2ndStep($loginID, $password);
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