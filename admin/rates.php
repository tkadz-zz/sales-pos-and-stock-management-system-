<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>


<div class="alert alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-percent"></span> Price Rates</h5>
</div>

<br>


<?php
$n = new Userview();
$n->viewSetRates('bond');
?>
<br>

<?php
$n = new Userview();
$n->viewSetRates('rtgs');
?>

<br>
<?php
$n = new Userview();
$n->viewSetRates('zar');
?>
<br>



<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>


