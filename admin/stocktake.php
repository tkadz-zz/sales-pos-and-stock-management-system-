<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>

<div class="alert alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-bacon"></span> Stock Take Session</h5>
</div>



<?php
$uid = $_GET['uid'];
$userView->viewStockTake($uid);
?>


<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>

