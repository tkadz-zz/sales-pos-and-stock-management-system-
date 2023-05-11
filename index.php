<?php
include("pageIncludes/autoloader.inc.php");

if(isset($_SESSION['id'])){
  $dir = $_SESSION['role'];
  echo "<script type='text/javascript'>
      window.location='$dir/';
      </script>";

}
else{
  echo "<script type='text/javascript'>
    window.location='signin.php';
    </script>";
}



 ?>
