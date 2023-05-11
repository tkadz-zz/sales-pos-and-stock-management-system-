<?php
include("../pageIncludes/autoloader.inc.php");

if(isset($_GET['resetPass'])) {
    //Reset User Password
    $userID = $_GET['userID'];
    try {
        $prof = new DefaultContr();
        $prof->resetUserPassword($userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}

elseif(isset($_POST['btn_update_user_status'])) {
    //Update User Login Status
    $userID = $_POST['userID'];
    $status = $_POST['status'];
    try {
        $prof = new DefaultContr();
        $prof->updateUserStatus($status, $userID);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}


elseif(isset($_POST['btn_updateProfile'])){
    $name = strtoupper($_POST['name']);
    $surname = strtoupper($_POST['surname']);
    $loginID= strtoupper($_POST['loginID']);
    $sex= strtoupper($_POST['sex']);

    $email= $_POST['email'];
    $phone= strtoupper($_POST['phone']);
    $address= strtoupper($_POST['address']);
    $id = $_SESSION['id'];
    try {
        $prof = new DefaultContr();
        $prof->updateProfile($name, $surname, $sex, $email, $phone, $address, $loginID, $id);
    } catch (TypeError $e) {
        echo "Error" . $e->getMessage();
    }
}

elseif(isset($_POST['btn_updatePassword'])){
    $op = $_POST['op'];
    $np = $_POST['np'];
    $cp = $_POST['cp'];
    $id = $_SESSION['id'];

    if($np != $cp){
        $_SESSION['type'] = 's';
        $_SESSION['err'] = 'New Password and Old Password Did Not Match';
        echo "<script type='text/javascript'>;
                      window.location='../password.php';
                    </script>";
    }
    else{
        try {
            $prof = new DefaultContr();
            $prof->updatePassword($op, $cp, $id);
        } catch (TypeError $e) {
            echo "Error" . $e->getMessage();
        }
    }

}



elseif(isset($_POST['btn_update_avatar'])) {
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
    $imgFile = $_FILES['avatar'];
    //File properties
    $file_name  =   $imgFile['name'];
    $file_tmp   =   $imgFile['tmp_name'];
    $file_size  =   $imgFile['size'];
    $file_error =   $imgFile['error'];
    $allowed    = array('jpg','jpeg','png');
    //Work out file extension
    $file_ext   =   explode('.',$file_name);
    $file_ext   = strtolower(end($file_ext));
    if(in_array($file_ext,$allowed)){
        if($file_error === 0){
            if($file_size <= 5242880){
                $file_name_new  = uniqid('',true).'.'.$file_ext;
                $file_destination   ='../avatar/'.$file_name_new;
                try {
                    $s = new DefaultContr();
                    $s->updateAvatar($file_tmp, $file_destination, $file_name_new, $file_ext, $role, $id);
                } catch (TypeError $e) {
                    echo "Error" . $e->getMessage();
                }
            }
            else{
                //Art Image too big
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Image should be 5MB or less in size';
                echo "<script>
                    history.back(-1);
                </script>";
            }
            // Initialise these two variables: $file_tmp, $file_destination, $file_name_new
        }
        else{
            //file not uploaded
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Image Format Not Supported';
            echo "<script>
                history.back(-1);
            </script>";
        }
    }
    else{
        //file extension error
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Image Should be either <span class="text-dark">JPG</span>, <span class="text-dark">JPEG</span> or <span class="text-dark">PNG</span> File Format. Your attempted file is in <span class="text-dark text-uppercase">.'.$file_ext.'</span> File Format';
        echo "<script>
                history.back(-1);
            </script>";
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