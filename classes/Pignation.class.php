<?php

class Pignation extends Model{



    protected function viewTransHistoryLoop($query){
        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        if(count($rows) > 0){
            $s = 0;
            foreach ($rows as $row)
            {
                $itemRows = $this->GetStockByID($row['itemID']);
                $s+=1;

                ?>
                <tr>
                    <td><?php echo $s ?> </td>
                    <td><?php
                        if(isset($itemRows[0]['name'])){
                            echo $row["transactionID"] .' ('. $itemRows[0]["name"] .')';
                        }
                        else{
                            echo $row["transactionID"];
                        }
                        ?></td>
                    <td>$<?php echo $row['price'] ?></td>
                    <td><?php echo $row['quantity'] ?></td>
                    <td><?php
                        if($row['paymentType'] == 'ecocash'){
                            echo 'ecocash: ' . $row['phoneNumber'];
                        }
                        elseif($row['paymentType'] == 'card'){
                            echo 'card: ' . $row['cardNumber'];
                        }
                        elseif($row['paymentType'] == 'cash'){
                            echo 'cash Payment';
                        }else{
                            echo $row['paymentType'] . ' Payment';
                        }
                        ?></td>
                    <td><?php echo $this->dateToDay($row['dateAdded']) ?> (<?php echo $this->timeAgo($row['dateAdded']) ?>)</td>
                </tr>




                <?php
            }
        }else{
            ?>
            <span class="badge badge-danger">No Transaction Records Found</span>
            <?php
        }
    }



    public function paging($query,$records_per_page){
        $starting_position=0;
        if(isset($_GET["page_no"])) {
            $starting_position=($_GET["page_no"]-1)*$records_per_page;
        }
        $query2=$query." limit $starting_position,$records_per_page";
        return $query2;
    }

    public function paginglinkOption($query,$records_per_page){
        ?>
        <div class="pt-4 pb-2">
        </div>
        <?php
        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $total_no_of_records = count($rows);


        if($total_no_of_records > 0)
        {
            ?>
            <div class="col-md-12">
                <tr>
                    <td colspan="12">
                        <?php
                        $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
                        $current_page=1;
                        if(isset($_GET["page_no"]))
                        {
                            $current_page=$_GET["page_no"];
                        }
                        if($current_page!=1)
                        {
                            $previous =$current_page-1;
                            ?>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=1"><span class="fa fa-chevron-circle-left"></span> First Page</a>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=<?php echo $previous ?>"><span class="fa fa-reply"></span> Previous Page</a>
                            <?php
                        }
                        ?>

                        <?php

                        if($current_page!=$total_no_of_pages)
                        {
                            $next=$current_page+1;
                            ?>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=<?php echo $next ?>">Next Page <span class="fa fa-chevron-circle-right"></span></a>
                            <a class="btn btn-" href="<?php echo $self ?>?page_no=<?php echo $total_no_of_pages ?>">Last Page <span class="fa fa-angle-double-right"></span></a>
                            <?php
                        }
                        ?>

                        <!-- Tkadz Select Page Loop -->
                        <hr>
                        <form action="<?= $self ?>" method="GET">
                            <div class="row">
                                <div class="col-md-2">
                                    <select name="page_no" class="form-control">
                                        <option value="<?= $current_page ?>">Page <?= $current_page ?> &#9678</option>
                                        <?php
                                        for($s=1; $s<$i; $s++){
                                            if($s != $current_page){
                                                ?>
                                                <option value="<?= $s ?>">Page <?= $s ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-primary -btn-sm">Go to page <span class="fa fa-chevron-right"></span></button>
                                </div>
                            </div>
                        </form>
                        <!-- Tkadz Select Page Loop -->
                    </td>
                </tr>
            </div>
            <?php
        }
    }

    public function paginationLinkNumbers($query,$records_per_page){
        $self = $_SERVER['PHP_SELF'];
        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $total_no_of_records = count($rows);

        $current_page = 1;
        if(isset($_GET["page_no"])) {
            $current_page=$_GET["page_no"];
        }
        $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
        $numpages = $total_no_of_pages;
        $dotshow = true;

        if( $current_page == 2 || $current_page == $numpages -1 ){
            $limit = 2;
        }else if($current_page >= 3 && $current_page != $numpages ){
            $limit = 1;
        }else{
            $limit = 3;
        }

        $previous = $current_page - 1;
        $next = $current_page + 1;

        if ($numpages != 1) {
            ?>
            <div class="col-md-12 pt-3">
                <tr>
                    <td colspan="12">
                        <?php if($current_page > 1){ ?>
                            <a class="btn btn-sm" href="<?php echo $self ?>?page_no=1"><span class="fa fa-chevron-circle-left"></span> First Page</a>
                            <a class="btn btn-sm" href="<?php echo $self ?>?page_no=<?php echo $previous ?>"><span class="fa fa-reply"></span> Previous Page</a>
                        <?php } ?>

                        <?php
                        for($i=1; $i <= $numpages; $i++){
                            if ($i == 1 || $i == $numpages ||  ($i >= $current_page - $limit &&  $i <= $current_page + $limit) ) {
                                $dotshow = true;
                                if ($i != $current_page){
                                    ?>
                                    <a class="btn btn-outline-primary btn-sm" href="<?php echo $self ?>?page_no=<?php echo $i ?>"><?php echo $i ?></a>
                                    <?php
                                }else{
                                    ?>
                                    <a class="btn btn-primary btn-sm" href="<?php echo $self ?>?page_no=<?php echo $i ?>"><?php echo $i ?></a>
                                    <?php
                                }
                            }else if ( $dotshow ){
                                $dotshow = false;
                                ?>
                                ...
                                <?php
                            }
                        }

                        if($current_page < $total_no_of_pages){ ?>
                            <a class="btn btn-sm" href="<?php echo $self ?>?page_no=<?php echo $next ?>">Next Page <span class="fa fa-chevron-circle-right"></span></a>
                            <a class="btn btn-sm" href="<?php echo $self ?>?page_no=<?php echo $total_no_of_pages ?>">Last Page <span class="fa fa-angle-double-right"></span></a>
                        <?php } ?>
                    </td>
                </tr>
            </div>
            <?php
        }
    }


}