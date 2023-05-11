<?php


class AuthenticationModel extends Dbh{

    protected function isUser($id, $role){
        $sql = "SELECT * FROM ".$role." WHERE userID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetUserByLoginID($loginID){
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$loginID]);
        return $stmt->fetchAll();
    }

    protected function SigninUser2ndStep($loginID, $password){
        $rowsUser = $this->GetUserByLoginID($loginID);
        $id = $rowsUser[0]['id'];
        $role = $rowsUser[0]['role'];

        $isUserRows = $this->isUser($id, $role);

        $tName = $isUserRows[0]['name'];
        $tSurname = $isUserRows[0]['surname'];

        $_SESSION['type'] = 's';
        $_SESSION['err'] = 'Welcome '.$tName. ' ' .$tSurname. '!';

        //Update User Password if it is empty then continue logging in
        if($rowsUser[0]['password'] == ''){
            $protectedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE users SET password=? WHERE loginID=?";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$protectedPassword, $loginID]);
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Password Set Successfully';
            $this->login($loginID);
        }
        else {
            $passwords = $rowsUser[0]['password'];
            if(password_verify($password, $passwords)){
                $this->login($loginID);
            }
            else{
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Wrong LoginID or Password';
                echo "<script type='text/javascript'>
                    window.location='../signin.php?loginID=$loginID';
                  </script>";
            }
        }

    }



    protected function login($loginID){
        $rowsUser = $this->GetUserByLoginID($loginID);
        $id = $rowsUser[0]['id'];
        $role = $rowsUser[0]['role'];

        $userRows = $this->isUser($id, $role);
        $today = date('Y-m-d H:i:s');

        //Update User Login Date
        $sql1 = "UPDATE users SET lastLogin=? WHERE id=?";
        $stmt1 = $this->con()->prepare($sql1);
        $stmt1->execute([$today, $id]);

        //Prepare Sessions
        $_SESSION['name'] = $userRows[0]['name'];
        $_SESSION['email'] = $userRows[0]['email'];
        $_SESSION['surname'] = $userRows[0]['surname'];
        $_SESSION['avatar'] = $userRows[0]['avatar'];
        $_SESSION['sex'] = $userRows[0]['sex'];
        $_SESSION['role'] = $rowsUser[0]['role'];
        $_SESSION['id'] = $rowsUser[0]['id'];


        if ($rowsUser[0]['status'] != 1) {
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'Your account (' . $userRows[0]['name'] . ' ' . $userRows[0]['surname'] . ') is temporarily deactivated. Contact the administrator to get this issue fixed';
            //if acc is deactive, destroy sessions
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            unset($_SESSION['surname']);

            echo "<script type='text/javascript'>
                    window.location='../signin.php?loginID=$loginID';
                  </script>";
        } else {
            //SessionMessages are already set above
            //redirect user to each correct directory
            //Note: all directory names are based on available user roles hence automating the process of redirecting
            echo "<script type='text/javascript'>
                    window.location='../$role/';
                  </script>";

        }
    }

    protected function SigninUser($loginID, $password)
    {
        $sql = "SELECT * FROM users WHERE loginID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$loginID]);
        $record = $stmt->fetchAll();

        /* Check if account is found */
        if(count($record) > 0) {
                //checkif passwrod is empty else proceed to login
                if($record[0]['password'] == ''){
                    //password not set
                    //set temporary session variables and redirect to set password
                    $_SESSION['loginIDTemp'] = $record[0]['loginID'];
                    $_SESSION['idTemp'] = $record[0]['id'];
                    $_SESSION['ids'] = $record[0]['id'];
                    $_SESSION['type'] = 's';
                    $_SESSION['err'] = 'Looks like this is your first time login-in! Please Choose a password of your choice to proceed';

                    echo "<script type='text/javascript'>;
                          window.location='../setPassword.php';
                        </script>";
                }
                else {
                    //Login Class
                    $this->SigninUser2ndStep($loginID, $password);
                }
        }
        else{
            //Account not found, wrong loginID
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Wrong LoginID or Password';
            echo "<script type='text/javascript'>;
                          window.location='../signin.php?loginID=".$loginID."';
                        </script>";
        }
    }

    protected function logout(){
        session_destroy();
        unset($_SESSION['id']);
        unset($_SESSION['name']);
        unset($_SESSION['surname']);
        unset($_SESSION['email']);
        unset($_SESSION['role']);
        unset($_SESSION['status']);
        unset($_SESSION['avatar']);
        echo "<script type='text/javascript'>
                  window.location='../signin.php';
              </script>";
    }

}