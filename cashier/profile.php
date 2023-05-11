
<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>
<div class="alert  alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-user-edit"></span> Profile</h5>
</div>






<?php

$n = new DefaultView();
$n->viewProfile($_SESSION['id']);

?>








<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>

