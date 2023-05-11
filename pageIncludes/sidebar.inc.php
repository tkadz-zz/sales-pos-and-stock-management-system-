<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i></i>
        </div>
        <img style="height: 30px" src="../<?php
        $n = new DefaultView();
        $n->viewWebLogo();
        ?>">

        <div class="sidebar-brand-text mx-3"><?php
            $n->viewWebShortName();
            ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <?php
    if($_SESSION['role'] == 'admin'){
        ?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-store"></i>
                <span>Stock</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Stock Options:</h6>
                    <a class="collapse-item" href="stock.php">Stock Inventory</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#reports"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-stamp"></i>
                <span>Stock Reports</span>
            </a>
            <div id="reports" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Choose Report:</h6>
                    <a class="collapse-item" href="dailyReport.php"">Daily Sales Report</a>
                    <a class="collapse-item" href="stocktakes.php">Stock Take Reports</a>
                    <a class="collapse-item" href="overallStats.php"">Overall Stock Report</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseOne"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-stream"></i>
                <span>Categories</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Categories:</h6>
                    <a class="collapse-item" href="categories.php">Manage Categories</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseThree"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-percent"></i>
                <span>Rates</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Price Rates:</h6>
                    <a class="collapse-item" href="rates.php">Update Rates</a>
                </div>
            </div>
        </li>
        <?php
    }
    ?>

    <?php
    if($_SESSION['role'] != 'admin'){
        ?>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-dollar-sign"></i>
                <span>Shopping</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Transaction:</h6>
                    <a class="collapse-item" href="../includes/additional.inc.php?action=newTransaction">New Transaction</a>
                    <a class="collapse-item" href="manualAdd.php">Manually Add</a>
                </div>
            </div>
        </li>
        <?php
    }
    ?>






    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
