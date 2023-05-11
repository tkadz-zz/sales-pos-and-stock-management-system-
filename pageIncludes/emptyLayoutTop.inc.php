<?php include 'autoloader.inc.php' ?>
<!-- Session Filter -->
<?php
if(!isset($_SESSION['id'])){
    echo '<script type="text/javascript">
        window.location="index.php";
        </script>';
}
?>
<?php include 'sessionFilter.inc.php' ?>
<?php include 'header.inc.php' ?>
<?php include 'sidebar.inc.php' ?>
<?php include 'navbar.inc.php' ?>
<?php include 'error_report.inc.php'; ?>
<?php


$userView = new Userview();
$defaultView = new DefaultView();
$userContr = new Usercontr();
$defaultContr = new DefaultContr();
$authContr = new AuthenticationContr();

//LOGOUT METHOD
if (isset($_GET['logout']) && ($_GET['logout'] == 'true')) {
    $authContr->logout();
}
?>



<?php
//BACK BUTTON METHOD
$myurl = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if (strpos($myurl, $_SESSION['role'].'/dashboard.php') !== false) {
}
else{
    ?>
    <br>
    <div class="pb-4">
        <a class="btn btn-sm shadow-sm" href="javascript:history.back()"><span class="fa fa-chevron-circle-left"> Back</span></a>
    </div>
    <?php
}
?>
