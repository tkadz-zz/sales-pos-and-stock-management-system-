<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>



<div class="alert alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-stream"></span> Categories</h5>
</div>

<div class="mt-4 mb-4">


    <div>
        <button type="button" class="btn mr-2 mb-2 btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-lg-addCategory">Add Category <span class="fa fa-plus-circle"></span> </button>
    </div>


    <div class="row">

        <div class="col-lg-3 col-sm-6">
            <div class="card-box bg-purple">
                <div class="inner">
                    <h3> <?php
                        $query = "SELECT * FROM categories";
                        $o = new Userview();
                        $o->CountView($query);
                        ?>
                    </h3>
                    <p> Categories</p>
                </div>
                <div class="icon">
                    <i class="fa fa-stream"></i>
                </div>

            </div>
        </div>
    </div>



    <div class="row">
        <div class="card-body">
            <p class="text-muted font-14 mb-3">
                All Categories>
            </p>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Date Added</th>
                        <th>More</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $n = new Userview();
                    $n->viewAllCategories();
                    ?>
                    </tbody>
                </table>
            </div>


        </div>


    </div>
</div>



<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>

<div class="modal fade bd-example-modal-lg-addCategory" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">

        <div class="modal-content">
            <form method="post" action="../includes/insert.inc.php">
                <div class="modal-body">
                    <div class="-modal-header">
                        <h5>Add Categories</h5>
                    </div>
                    <hr>
                    <div class="form-row row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail4" class="col-form-label">Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Add Category Name" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button name="btn_add_category" type="submit"  class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
