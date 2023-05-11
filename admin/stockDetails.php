<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>

<div class="alert alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-edit"></span> Product Details</h5>
</div>

<?php
$n = new Userview();
$n->viewStockDetails($_GET['itemID']);
?>






<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>

