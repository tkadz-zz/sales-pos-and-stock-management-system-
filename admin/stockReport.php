<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>

<div class="alert alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-pen-alt"></span> Stock Take Report : <?= $_GET['uid'] ?></h5>
</div>



<?php
$uid = $_GET['uid'];
$userView->viewStockTakeReport($uid);
?>


<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>

