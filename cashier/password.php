<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>

<div class="alert  alert-secondary shadow-sm text-dark border-bottom-primary">
    <h5><span class="fa fa-lock"></span> Password</h5>
</div>






<?php

$n = new DefaultView();
$n->viewChangePassword();

?>







<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>
