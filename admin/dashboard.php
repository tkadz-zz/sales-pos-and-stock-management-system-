<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>



<div class="alert alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-tachometer-alt"></span> Dashboard</h5>
</div>
<br>

    <div>
        <a data-toggle="modal" data-target="#addUserModal" href="#!" id="#!" class="btn btn-outline-primary"><span class="fa fa-user-plus"></span> Add User</a>
    </div>

    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-blue">
                <div class="inner">
                    <h3>
                        <?php
                        $query = "SELECT * FROM users";
                        $o = new DefaultView();
                        $o->CountView($query);
                        ?>
                    </h3>
                    <p> All System Users </p>
                </div>
                <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-green">
                <div class="inner">
                    <h3> <?php
                        $query = "SELECT * FROM admin";
                        $o = new DefaultView();
                        $o->CountView($query);
                        ?> </h3>
                    <p> Admin Accounts </p>
                </div>
                <div class="icon">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </div>

            </div>
        </div>

        <?php
        $n = new DefaultView();
        $n->accountStatsLoop();
        ?>

    </div>


    <div class="row">
        <div class="col-12">
            <!-- Uncomment button below to print the system users table contents -->
            <!-- <button onclick="printDiv('printableArea')" class="btn btn-outline-dark"><i class="fa fa-print"> Print</i></button> -->
            <div id="printableArea" class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">System Users</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Role</th>
                                <th>status</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Surname</th>
                                <th>Role</th>
                                <th>status</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            <?php
                            $n = new DefaultView();
                            $n->ViewAllUsers();
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>


    </div>




<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>


