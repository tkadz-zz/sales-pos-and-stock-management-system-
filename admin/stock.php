<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>
<div class="alert alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-boxes"></span> Stock Inventory</h5>
</div>

<style>
        .card-box {
            position: relative;
            color: #fff;
            padding: 20px 10px 40px;
            margin: 20px 0px;
        }
        .card-box:hover {
            text-decoration: none;
            color: #f1f1f1;
        }
        .card-box:hover .icon i {
            font-size: 100px;
            transition: 1s;
            -webkit-transition: 1s;
        }
        .card-box .inner {
            padding: 5px 10px 0 10px;
        }
        .card-box h3 {
            font-size: 27px;
            font-weight: bold;
            margin: 0 0 8px 0;
            white-space: nowrap;
            padding: 0;
            text-align: left;
        }
        .card-box p {
            font-size: 15px;
        }
        .card-box .icon {
            position: absolute;
            top: auto;
            bottom: 5px;
            right: 5px;
            z-index: 0;
            font-size: 72px;
            color: rgba(0, 0, 0, 0.15);
        }
        .card-box .card-box-footer {
            position: absolute;
            left: 0px;
            bottom: 0px;
            text-align: center;
            padding: 3px 0;
            color: rgba(255, 255, 255, 0.8);
            background: rgba(0, 0, 0, 0.1);
            width: 100%;
            text-decoration: none;
        }
        .card-box:hover .card-box-footer {
            background: rgba(0, 0, 0, 0.3);
        }
        .bg-blue {
            background-color: #00c0ef !important;
        }
        .bg-green {
            background-color: #00a65a !important;
        }
        .bg-orange {
            background-color: #f39c12 !important;
        }
        .bg-red {
            background-color: #d9534f !important;
        }
        .bg-purple {
            background-color: #aa35b2 !important;
        }
        .bg-lime {
            background-color: rgba(50, 56, 55, 0.98) !important;
        }

    </style>

    <div class="mt-4 mb-4">


        <div>
            <button type="button" class="btn mr-2 mb-2 btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-lg-addStock">Add Stock Products <span class="fa fa-plus-circle"></span> </button>
        </div>


        <div class="row">

            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-red">
                    <div class="inner">
                        <h3> <?php
                            $query = "SELECT * FROM stock";
                            $o = new Userview();
                            $o->CountView($query);
                            ?>
                        </h3>
                        <p> Stock Products</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-boxes"></i>
                    </div>

                </div>
            </div>
        </div>

<hr>

        <div class="row">
            <div class="card-body">
                <p>All Stock Products and Quantities</p>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Bar#</th>
                                <th>Selling Price</th>
                                <th>Buying Price</th>
                                <th>Remaining / Quantity</th>
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


        </div>
    </div>







<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>



<div class="modal fade bd-example-modal-lg-addStock" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <form method="post" action="../includes/insert.inc.php">
                <div class="modal-body">
                    <div class="-modal-header">
                        <h5>Add New Stock</h5>
                    </div>
                    <hr>
                    <div class="form-row row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="col-form-label">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Stock Supply Name" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="col-form-label">BarCode</label>
                            <input name="barCode" type="number" class="form-control" placeholder="Barcode |||||">
                        </div>

                    </div>

                    <div class="form-row row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail4" class="col-form-label">Buying Price ($USD)</label>
                            <input name="buyingPrice" type="number" step="0.01" min="0.01" class="form-control" placeholder="Bought at $..." required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="inputEmail4" class="col-form-label">Selling Price ($USD)</label>
                            <input name="sellingPrice" type="number" step="0.01" min="0.01" class="form-control" placeholder="Selling at $..." required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputEmail4" class="col-form-label">Category</label>
                            <select name="category" class="form-control form-select">
                                <option value=""> -- SELECT CATEGORY --</option>
                                <option value="0">set later</option>
                                <?php
                                $n = new Userview();
                                $n->viewCategoryOptionLoop();
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row row">
                        <div class="form-group col-md-3">
                            <label for="inputEmail4" class="col-form-label">Quantity</label>
                            <input name="quantity" type="number" min="1" class="form-control" placeholder="Quantity of supplies" required>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button name="btn_add_Stock" type="submit"  class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

