<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>


<div class="alert alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-calculator"></span> Overall Stock Report</h5>
</div>



<div class="mt-4 mb-4">

    <?php
    $n = new Userview();
    $n->overallStats();
    ?>

</div>


<hr>
<p class="text-muted font-14 mb-3">
    All Time Purchase History
</p>
<br>
<div class="row">
    <div class="col-md-6"></div>
    <div class="s003 col-md-6 -shadow-sm">
        <form method="GET">
            <label><span class="fa fa-search"></span> Search</label>
            <div class="inner-form row">
                <div class="input-field second-wrap col-md-8">
                    <input class="form-control" <?php if(isset($_GET['search'])){?> value="<?php echo $_GET['search'] ?>" <?php } ?> id="search" pattern="[ a-zA-Z0-9]+" name="search" type="search" placeholder="Search By Name/TransactionID/Payment" />
                </div>
                <div class="input-field third-wrap col-md-4">
                    <button class="btn btn-primary" type="submit">
                        Search
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="row">

    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>TransID / Name</th>
                    <th>Total Price</th>
                    <th>Quantities Sold</th>
                    <th>Payment</th>
                    <th>Date</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $query = "SELECT * FROM payment WHERE transactionID LIKE '%$search%' OR paymentType LIKE '%$search%' OR dateAdded LIKE '%$search%' ORDER BY id DESC";
                } else {
                    $query = "SELECT * FROM payment ORDER BY id DESC";
                }
                $limit = 10;
                $n = new PignationView();
                $n->viewAllPurchaseHistory($limit, $query);
                ?>
                </tbody>


            </table>
        </div>


    </div>


</div>









<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>
