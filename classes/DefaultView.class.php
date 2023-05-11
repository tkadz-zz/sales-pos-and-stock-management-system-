<?php

class DefaultView extends DefaultModel{

    public function accountStatsLoop(){
        $rows = $this->GetAllUserRoles();
        $s=0;
        foreach ($rows as $row){
            $s+=1;
            if($s == 1){
                $color = 'darkPurple';}
            if($s == 2){
                $color = 'purple';}
            if($s == 3){
                $color = 'red';}
            if($s == 4){
                $color = 'blue';}
            if($s == 5){
                $color = 'lime';}

            ?>
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-<?php echo $color ?>">
                    <div class="inner">
                        <h3> <?php
                            $query = "SELECT * FROM  ".$row['valueName']." ";
                            $o = new DefaultView();
                            $o->CountView($query);
                            ?> </h3>
                        <p> <?php echo $row['valueName'] ?> Accounts </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </div>

                </div>
            </div>
            <?php
        }
    }

    public function viewChangePassword(){
        ?>
        <div class="container card-body col-md-12 card grid-margin stretch-card rounded bg-white mt-4 mb-4">
            <div class="row">
                <div class="col-md-8 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>

                        </div>
                        <form method="post" action="../includesDefault/update.inc.php" >
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">Current Password</label>
                                    <input name="op" type="password" class="form-control" placeholder="Current Password" required>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="labels">New Password</label>
                                    <input id="password" name="np" type="password" class="form-control" placeholder="New Password" onkeyup='check();' minlength="8" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="labels">Confirm New Password</label>
                                    <input id="confirmPassword" name="cp" type="password" class="form-control" placeholder="Confirm New Password" onkeyup='check();' minlength="8" required>
                                </div>
                            </div>

                            <script>
                                var check = function() {
                                    if (document.getElementById('password').value ==
                                        document.getElementById('confirmPassword').value) {
                                        document.getElementById('message').style.color = 'green';
                                        document.getElementById("save-btn").disabled = false;
                                        document.getElementById('message').innerHTML = '<div id="divDis" class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-success"><span class="fa fa-check-circle"></span>Password matched</div>';
                                    }
                                    else {
                                        document.getElementById('message').style.color = 'red';
                                        document.getElementById("save-btn").disabled = true;
                                        document.getElementById('message').innerHTML = '<div class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-danger"><span class="fa fa-exclamation-circle"></span>New Password not matching Confirm Password</div>';
                                    }


                                }
                            </script>

                            <div>

                                <span id='message'></span>

                            </div>


                            <div class="mt-5 text-center">
                                <button id="save-btn" name="btn_updatePassword" class="btn btn-primary" type="submit">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center experience">
                            <span>Additional Settings</span>
                        </div>
                        <hr>
                        <a href="profile.php" class="btn btn-dark align-items-center"> <span class="fa fa-user-edit"></span> Update Profile <span class="fa fa-arrow-right"></span></a>

                    </div>
                </div>

            </div>
        </div>
        <?php
    }



    public function viewAvatar($id, $width){
        $UserT = $this->GetUserByID($id);
        $userRows = $this->isUser($id, $UserT[0]['role']);
        if($userRows[0]['avatar'] == ''){
            if($userRows[0]['sex'] == 'MALE'){
                ?>
                <img class="img-profile rounded-circle" width="<?php echo $width ?>px" src="../assets/img/male.png">
                <?php
            }
            elseif ($userRows[0]['sex'] == 'FEMALE'){
                ?>
                <img class="img-profile rounded-circle" width="<?php echo $width ?>px" src="../assets/img/female.png">
                <?php
            }
            else{
                ?>
                <img class="img-profile rounded-circle" width="<?php echo $width ?>px" src="../assets/img/user.png">
                <?php
            }
        }
        else{
            ?>
            <img class="img-profile rounded-circle" width="<?php echo $width ?>px" height="<?php echo $width ?>px" src="<?php echo $userRows[0]['avatar'] ?>">
            <?php
        }
    }


    public function viewUpdateAvatar($id){
        if(!isset($_GET['setProfileImage'])){
            $width = '150';
            $this->viewAvatar($id, $width);
            ?>
            <div class="shadow-sm myhover">
                <a class="p-2" data-toggle="tooltip" data-placement="right" title="Update Profile Picture" href="?setProfileImage"><span class="fa fa-camera"></span></a>
                <a class="p-2 text-danger"onclick="return confirm('Are you sure you want to remove this picture?')"  data-toggle="tooltip" data-placement="right" title="Delete Profile Picture" href="../includesDefault/delete.inc.php?delAvatar"><span class="fa fa-trash"></span></a>
            </div>
            <?php
        }
        else{
            ?>
            <div class="animated--grow-in text-dark fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-success">
                <span class="animated--grow-in fadeout fa fa-info-circle"></span> <span class="text-xs">Update Image Below</span>
            </div>
            <form method="POST" action="../includesDefault/update.inc.php" enctype="multipart/form-data">
                <div>
                    <input type="file" name="avatar" id="preview" class="form-control text-xs" required>
                </div>
                <br>
                <div>
                    <img style="width: 100%" id="showpreview" src="#" />
                </div>
                <hR>
                <div>
                    <a onclick="history.back(-1)" class="btn btn-sm btn-outline-warning">Cancel <span class="fa fa-times"></span></a>
                    <button name="btn_update_avatar" type="submit" class="btn btn-outline-primary text-xs"><span class="fa fa-camera"></span> Updload</button>
                </div>
            </form>
            <div>
            </div>
            <script>
                preview.onchange = evt => {
                    const [file] = preview.files
                    if (file) {
                        showpreview.src = URL.createObjectURL(file)
                    }
                }
            </script>
            <hr>
            <?php
        }
    }

    public function viewProfile($id){
        $userRows = $this->isUser($id, $_SESSION['role']);
        $rows = $this->GetUserByID($id);
        ?>
        <div class="--container card-body card --grid-margin --stretch-card rounded bg-white mt-4 mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <div class="p-2">
                                <?php
                                $this->viewUpdateAvatar($id);
                                ?>
                            </div>
                            <span class="font-weight-bold"><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname']   ?></span>
                            <span class="text-black-50"><?php echo $userRows[0]['email'] ?></span>
                            <span> </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center experience">
                                <span>Profile Settings</span>
                            </div>
                            <hr>
                            <form class="form" method="post" action="../includesDefault/update.inc.php">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label class="labels">Login-ID</label>
                                        <input name="loginID" type="text" class="form-control" placeholder="New Login-ID..." value="<?php echo $rows[0]['loginID']  ?>" >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label class="labels">Name</label>
                                        <input name="name" type="text" class="form-control" placeholder="first name" value="<?php echo $userRows[0]['name'] ?>" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="labels">Surname</label>
                                        <input name="surname" type="text" class="form-control" value="<?php echo $userRows[0]['surname'] ?>" placeholder="your surname" required>
                                    </div>

                                    <div class="col-md-6 pt-2">
                                        <label class="labels">Gender</label>
                                        <select class="form-control form-select" name="sex">
                                            <option value="<?php echo $userRows[0]['sex'] ?>"><?php echo $userRows[0]['sex'] ?></option>
                                            <?php
                                            if($userRows[0]['sex'] == 'MALE'){
                                                ?>
                                                <option value="FEMALE">FEMALE</option>
                                                <option value="PRIVATE">PRIVATE</option>
                                                <?php
                                            }
                                            elseif ($userRows[0]['sex'] == 'FEMALE'){
                                                ?>
                                                <option value="MALE">MALE</option>
                                                <option value="PRIVATE">PRIVATE</option>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <option value="MALE">MALE</option>
                                                <option value="FEMALE">FEMALE</option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Fileds here -->
                                <br>
                                <div class="form-row pt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Email</label>
                                        <input name="email" type="email" class="form-control" placeholder="enter your/company email..." value="<?php echo $userRows[0]['email'] ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Mobile Number</label>
                                        <input name="phone" type="text" class="form-control" placeholder="enter phone number..." value="<?php echo $userRows[0]['phone'] ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Address</label>
                                        <input name="address" type="text" class="form-control" placeholder="enter your address..." value="<?php echo $userRows[0]['address'] ?>">
                                    </div>
                                </div>


                                <div>
                                    <div class="pt-5 text-center">
                                        <button name="btn_updateProfile" class="btn btn-primary" type="submit">Save Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center experience">
                                <span>Additional Settings</span>
                            </div>
                            <hr>
                            <a href="password.php" class="btn btn-dark align-items-center"> <span class="fa fa-lock"></span> Change Password <span class="fa fa-arrow-right"></span></a>
                            <br>
                        </div>
                    </div>
                </div>
        </div>
        <?php
    }


    public function viewWebFullName(){
        $rows = $this->GetWebDetails();
        echo $rows[0]['webNameFull'];
    }

    public function viewWebShortName(){
        $rows = $this->GetWebDetails();
        echo $rows[0]['webNameShort'];
    }

    public function viewWebLogo(){
        $rows = $this->GetWebDetails();
        echo $rows[0]['webLogo'];
    }

    public function viewWebSlogan(){
        $rows = $this->GetWebDetails();
        echo $rows[0]['webSlogan'];
    }

    public function viewWebFooter(){
        $rows = $this->GetWebDetails();
        echo $rows[0]['webFooter'];
    }

    public function viewWebYear(){
        $rows = $this->GetWebDetails();
        echo $rows[0]['webYear'];
    }

    public function viewWebDescription(){
        $rows = $this->GetWebDetails();
        echo $rows[0]['webDescription'];
    }



    public function userRolesLoop(){
        $rows = $this->GetAllUserRoles();
        foreach ($rows as $row){
            ?>
            <option value="<?php echo $row['valueName'] ?>"><?php echo $row['viewName'] ?></option>
            <?php
        }
    }

    public function userProfile($id){
        $rows = $this->GetUserByID($id);
        if(count($rows) > 0){
            $userRows = $this->isUser($id, $rows[0]['role']);
            if($rows[0]['status'] == 1){
                $status = 'Active';
                $statusBadge = 'success';
            }
            else{
                $status = 'Not Active';
                $statusBadge = 'danger';
            }
            ?>
            <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
                <div class="row">
                    <div class="col-md-3 -border-right">
                        <?php
                        $width = '150';
                        $n = new DefaultView();
                        $n->viewAvatar($id, $width);
                        ?>
                        <div class="pt-2" style="font-size: 13px"><strong>Sex: </strong><span><?php echo $userRows[0]['sex'] ?></span></div>
                    </div>
                    <div class="col-md-5 -border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <div class="pb-3" style="font-size: 13px"><strong>Full Name: </strong><span><?php echo $userRows[0]['name'] .' '. $userRows[0]['surname'] ?></span></div>
                            <div class="pb-3" style="font-size: 13px"><strong>LoginID: </strong><span><?php echo $rows[0]['loginID'] ?></span></div>
                            <div class="pb-3" style="font-size: 13px"><strong>Account Type: </strong><span><?php echo $rows[0]['role'] ?> Account</span></div>
                            <div class="pb-3" style="font-size: 13px"><strong>Email Address: </strong><span><a href="mailto: <?php echo $userRows[0]['email'] ?>"><?php echo $userRows[0]['email'] ?></a></span></div>
                            <div class="pb-3" style="font-size: 13px"><strong>Phone Number: </strong><span><?php echo $userRows[0]['phone'] ?></span></div>
                            <div class="pb-3" style="font-size: 13px"><strong>Address: </strong><span><?php echo $userRows[0]['address'] ?></span></div>
                            <div class="pb-3" style="font-size: 13px"><strong>Last Login: </strong>
                                <span>
                                    <?php
                                    if($rows[0]['lastLogin'] == ''){
                                        echo 'Never Logged In';
                                    }else{
                                        echo $this->dateTimeToDay($rows[0]['lastLogin']) .' ('. $this->timeAgo($rows[0]['lastLogin']) .')';
                                    }
                                    ?>
                                </span>
                            </div>
                            <div class="pb-3" style="font-size: 13px"><strong>Date Joined: </strong><span><?php echo $this->dateToDay($rows[0]['joined']) ?> (<?php echo $this->timeAgo($rows[0]['joined']) ?>)</span></div>
                            <div class="pb-3" style="font-size: 13px"><strong>Account Status: </strong><span class="text text-<?php echo $statusBadge ?>"><?php echo $status ?></span></div>
                            <div class="pb-3" style="font-size: 13px"><strong>Password: </strong><span><?php
                                    if($rows[0]['password'] == ''){
                                        ?>
                                        <span class="fa fa-times-circle text-danger"> Not Set</span>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <span class="fa fa-check-circle text-success"> Set</span>
                                        <?php
                                    }
                                    ?></span></div>
                            <br>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <?php
                        //IF FETCHED ACCOUNT IS THE CURRENT LOGGED-IN ACCOUNT, HIDE THE STATUS AND DELETE ACCOUNT OPTIONS
                        if($_SESSION['id'] != $id){
                            ?>
                            <div>
                                <form method="POST" action="../includesDefault/update.inc.php">
                                    <span style="font-size: 13px">Account Status </span> : <span class="badge badge-<?php echo $statusBadge ?>"><?php echo $status ?></span>
                                    <div class="pb-1">
                                        <input name="userID" value="<?php echo $id ?>" hidden>
                                        <select name="status" class="form-control form-select">
                                            <option value="<?php echo $rows[0]['status']  ?>"><?php echo $status ?> (current)</option>
                                            <?php
                                            if($rows[0]['status'] == 1){
                                                ?>
                                                <option value="0">DeActivate</option>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <option value="1">Activate</option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" name="btn_update_user_status" class="btn btn-primary btn-sm">Update</button>
                                </form>
                            </div>

                            <hr>
                            <div>
                                <label>Reset User Password</label><br>
                                <a onclick="return confirm('Are you sure you want to reset user password?')" href="../includesDefault/update.inc.php?resetPass&userID=<?php echo $id ?>" class="btn btn-outline-primary"> Reset User Password</a>
                            </div>


                            <hr>
                            <div>
                                <label>Delete User Account</label><br>
                                <a style="font-size: 18px" class="nav-link" onclick="return confirm('This Account and all data related to this account will be permanently deleted. Continue?')" id="profile-tab" -data-bs-toggle="tab" href="../includesDefault/delete.inc.php?delUser&userID=<?php echo $_GET['userID'] ?>" role="tab" aria-selected="false"><span class="btn btn-outline-danger fa fa-trash">PERMANENTLY DELETE <span class="fa fa-trash"></span> </span></a>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
            <?php
        }
        else{
            ?>
            <div class="container card-body card grid-margin stretch-card rounded bg-white mt-4 mb-4">
                <div class="row">

                    <div class="col-md-12 -border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <span class="fa fa-exclamation-triangle"></span> Account Not Found
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }

    public function CountView($query){
        $rows = $this->GetCountView($query);
        echo count($rows);
    }

    public function ViewAllUsers(){
        $rows = $this->GetAllUser();
        $s = 0;
        foreach ($rows as $row)
        {
            if($row['role'] == 'admin'){
                $rowsUser = $this->isUser($row['id'], $row['role']);
                $color = '#00a65a';
            }
            else{
                $rowsUser = $this->isUser($row['id'], $row['role']);
                $color = 'orange';
            }


            $s++;
            ?>

            <tr>
                <td><?php echo $s ?> </td>
                <td><a href="userProfile.php?userID=<?php echo $row['id'] ?>"><?php echo $rowsUser[0]["name"] ?></a></td>
                <td><a href="userProfile.php?userID=<?php echo $row['id'] ?>"><?php echo $rowsUser[0]["surname"]; ?></a></td>
                <td><span style="color: <?php echo $color ?>" class="badge bg-white rounded"><?php echo $row["role"] ?></span> </td>
                <td><?php
                    if($row['status'] == 1) {
                        ?>
                        <span class="badge badge-success rounded">active</span>
                        <?php
                    }
                    else{
                        ?>
                        <span class="badge badge-danger rounded">Inactive</span>
                        <?php
                    }
                    ?>

                </td>
            </tr>

            <?php
        }
    }

}