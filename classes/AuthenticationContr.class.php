<?php
class AuthenticationContr extends AuthenticationModel {


    public function SigninUser2ndStep($loginID, $password){
        parent::SigninUser2ndStep($loginID, $password);
    }

    public function SigninUser($loginID, $password){
        parent::SigninUser($loginID, $password);
    }

    public function logout(){
        parent::logout();
    }

}
