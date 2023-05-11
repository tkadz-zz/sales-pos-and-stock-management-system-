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
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>

                                    <div class="text-center">
                                        <?php include 'pageIncludes/error_report.inc.php'; ?>
                                    </div>
                                    <form class="user" method="POST" action="includesDefault/authentication.inc.php">
                                        <div class="form-group">
                                            <input type="text"
                                                   class="form-control form-control-user"
                                                   id="exampleInputText" aria-describedby="textHelp"
                                                   placeholder="Enter Your Login-ID..."
                                                   name="loginID"
                                                   value="<?php
                                                   if(isset($_GET['loginID'])){
                                                       echo $_GET['loginID'];
                                                   }
                                                   else{
                                                       '';
                                                   }
                                                   ?>"
                                            >

                                        </div>
                                        <div class="form-group">
                                            <input type="password"
                                                   class="form-control form-control-user"
                                                   id="exampleInputPassword"
                                                   placeholder="Password"
                                                   name="password"
                                            >

                                        </div>




                                        <button name="btn_signin" class="btn btn-primary btn-user btn-block">
                                            Login <span class="fa fa-sign-in"></span>
                                        </button>


                                        <!--
                                        <hr>
                                        <a href="assets/index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="assets/index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                        -->
                                    </form>
                                    <hr>




                                    <!--
                                    <div class="text-center">
                                        <a class="small" href="#!">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="signup.php">Create an Account!</a>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

<?php include 'pageIncludes/authFooter.inc.php'; ?>