<?php

class DefaultContr extends DefaultModel{

    public function isUser($id, $role)
    {
        return parent::isUser($id, $role);
    }

    public function GetUserByID($id)
    {
        return parent::GetUserByID($id);
    }

    public function delAvatar($role, $id){
        parent::delAvatar($role, $id);
    }

    public function updateAvatar($file_tmp, $file_destination, $file_name_new, $file_ext, $role, $id){
        parent::updateAvatar($file_tmp, $file_destination, $file_name_new, $file_ext, $role, $id);
    }

    public function addUser($name, $surname, $loginID, $userRole, $activeStatus){
        parent::addUser($name, $surname, $loginID, $userRole, $activeStatus);
    }

    public function updatePassword($op, $cp, $id){
        parent::updatePassword($op, $cp, $id);
    }

    public function updateProfile($name, $surname, $sex, $email, $phone, $address, $loginID, $id){
        parent::updateProfile($name, $surname, $sex, $email, $phone, $address, $loginID, $id);
    }

    public function updateUserStatus($status, $userID){
        parent::updateUserStatus($status, $userID);
    }

    public function delUser($userID){
        parent::delUser($userID);
    }

    public function resetUserPassword($id){
        parent::resetUserPassword($id);
    }

}