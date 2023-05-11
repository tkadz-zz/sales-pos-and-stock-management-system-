<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>


<div class="alert alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-plus-circle"></span> Add Sold Products</h5>
</div>

<div class="row">
    <div class="col-md-6 card">
        <div class="card-body">
            <p class="text-muted font-14 mb-3">
                Add Sales Manually
            </p>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Remaining</th>
                        <th>More</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    $n = new Userview();
                    $n->viewALlStcokManualAdd();
                    ?>
                    </tbody>


                </table>
            </div>


        </div>
    </div>





    <div class="col-md-6">
        <?php
        if(isset($_GET['addManually'])){
            $itemID = $_GET['itemID'];
            $c = new Userview();
            $c->viewAddManually($itemID);
        }
        ?>
    </div>
</div>

<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>


