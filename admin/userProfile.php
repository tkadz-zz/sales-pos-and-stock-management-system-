<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>

    <div class="alert alert-secondary shadow-sm text-dark border-bottom-primary">
        <h5><span class="fa fa-user-edit"></span> User Profile</h5>
    </div>

<?php

$n = new DefaultView();
$n->userProfile($_GET['userID']);

?>








<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>