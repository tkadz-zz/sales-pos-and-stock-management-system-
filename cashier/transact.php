<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>



<div class="alert alert-success shadow-sm text-dark border-bottom-success">
    <h5><span class="fa fa-shopping-basket"></span> Transaction Page</h5>
</div>

<div class="row">
    <div class="card-body col-md-6">
        <p class="text-muted font-14 mb-3">
            Stock
        </p>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Bar#</th>
                    <th>Selling Price</th>
                    <th>Quantity</th>
                    <th>More</th>
                </tr>
                </thead>

                <tbody>
                <?php
                $n = new Userview();
                $n->viewAllStock();
                ?>
                </tbody>
            </table>
        </div>
    </div>



    <?php
    if(isset($_GET['addCart'])){
    ?>
    <div class="col-md-6">
        <?php
        $carv = new UserView();
        $carv->viewAddCart($_GET['itemID']);
        ?>
    </div>
    <?php
    }
    else{
    ?>
    <div class="col-md-6">
        <?php
        $carv = new UserView();
        $carv->viewCart($_SESSION['transactionID']);
        ?>
    </div>
    <?php
    }
    ?>


</div>





<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>

