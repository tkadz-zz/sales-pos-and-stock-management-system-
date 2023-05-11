<?php
if (!isset($_SESSION['id'])) {
    echo "<script type='text/javascript'>
                    history.back(-1);
                </script>";
}