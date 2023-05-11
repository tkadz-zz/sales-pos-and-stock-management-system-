<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>

<br>
    <h5>User Profile</h5>
    <br>

<?php

$n = new DefaultView();
$n->userProfile($_GET['userID']);

?>








<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>