<?php include 'pageIncludes/authHeader.inc.php'; ?>

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block --bg-login-image">
                            <div class="text-center pt-5">
                                <h3>
                                    <?php
                                    $n = new DefaultView();
                                    $n->viewWebFullName();
                                    ?>
                                </h3>
                                <h5>
                                    <img style="width: 100%" src="<?= $n->viewWebLogo() ?>">
                                </h5>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Set Password</h1>
                                </div>
                                <br>

                                <div class="text-center">
                                    <?php include 'pageIncludes/error_report.inc.php'; ?>
                                </div>

                                <form class="user" method="POST" action="includesDefault/authentication.inc.php">
                                    <div class="form-group row">

                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user"
                                                   id="password"
                                                   placeholder="Password"
                                                   name="password"
                                                   required
                                                   onkeyup='check();'
                                                   minlength="8"
                                            >

                                        </div>

                                        <br>


                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user"
                                                   id="confirmPassword"
                                                   placeholder="Repeat Password"
                                                   name="confirmPassword"
                                                   required
                                                   onkeyup='check();'
                                                   minlength="8"
                                            >
                                        </div>

                                        <br>

                                        <div>

                                            <span id='message'></span>

                                        </div>



                                        <br>



                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember
                                                Me</label>
                                        </div>
                                    </div>
                                    -->
                                    <button id="save-btn" name="setpassword_btn" class="btn btn-primary btn-user btn-block">
                                        <span class="fa fa-check-circle"> Done </span> <span class="fa fa-sign-in"></span>
                                    </button>

                                    <br>
                                    <script type="text/javascript">
                                        //close div in 5 secs
                                        window.setTimeout("closeDisDiv();", 6000);

                                        function closeDisDiv(){
                                            document.getElementById("divDis").style.display="none";
                                            $(".fadeout").click(function (){
                                                $("div").fadeOut();
                                            });
                                        }
                                    </script>


                                    <script>
                                        var check = function() {
                                            if (document.getElementById('password').value ==
                                                document.getElementById('confirmPassword').value) {
                                                document.getElementById('message').style.color = 'green';
                                                document.getElementById("save-btn").disabled = false;
                                                document.getElementById('message').innerHTML = '<div id="divDis" class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-success"><span class="fa fa-check-circle"></span> Password matched</div>';
                                            }
                                            else {
                                                document.getElementById('message').style.color = 'red';
                                                document.getElementById("save-btn").disabled = true;
                                                document.getElementById('message').innerHTML = '<div class="animated--grow-in fadeout my-3 p-3 bg-white rounded shadow-sm alert alert-danger"><span class="fa fa-exclamation-circle"></span> Password not matching Confirm Password</div>';
                                            }


                                        }
                                    </script>

                                </form>

                                <hr>
                                <div class="text-center">
                                    <a class="small" href="signin.php">Login</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

<?php include 'pageIncludes/authFooter.inc.php'; ?>