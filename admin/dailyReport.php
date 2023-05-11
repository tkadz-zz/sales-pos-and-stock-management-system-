<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>


<div class="alert alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-percent"></span> Daily Sales Report</h5>

</div>

<?php
$todayDate = date('Y-m-d');
if(isset($_POST['btn-datepickerSubmit'])){
    $searchDate = $_POST['otherDate'];
}else{
    $searchDate = $todayDate;
}
?>

<span>Today's Date is: <a href="?date"><?= $userContr->dateToDay($todayDate) ?></a></span>
<hr>
<div class="row">
    <div class="col-md-4">Choose date
        <form method="POST">
            <div class="form-row">
                <div class="col-lg-9">
                    <input type="date" name="otherDate" value="<?= $searchDate ?>" class="form-control" max="<?= $todayDate ?>" required>
                </div>
                <div class="col-lg-3">
                    <button class="btn btn-sm btn-outline-primary" type="submit" name="btn-datepickerSubmit"><span class="fa fa-eye"></button>
                </div>
            </div>
        </form>
    </div>



    <div class="col-md-8">
        <?php
        if(isset($_GET['date']) || isset($_POST['btn-datepickerSubmit'])) {
            $userView->viewDailyReport($searchDate);
        }
        ?>
    </div>
</div>






<br>



<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>


