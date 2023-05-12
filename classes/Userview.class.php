<?php

class Userview extends Model {

    public function viewAmountByPaymentType($day){
        $today = '%'.$day.'%';

        $usdType = '%usd%';
        $zarType = '%zar%';
        $bondType = '%bond%';
        $rtgsType = '%rtgs%';

        $usdAmount = 0;
        $zarAmount = 0;
        $bondAmount = 0;
        $rtgsAmount = 0;

        $usd = $this->GetAmountByPaymentType($usdType, $today);
        foreach ($usd as $usdRow) {
            $usdAmount += $usdRow['price'];
        }

        $zar = $this->GetAmountByPaymentType($zarType, $today);
        foreach ($zar as $zarRow) {
            $zarAmount += $zarRow['price'];
        }

        $bond = $this->GetAmountByPaymentType($bondType, $today);
        foreach ($bond as $bondRow) {
            $bondAmount += $bondRow['price'];
        }

        $rtgs = $this->GetAmountByPaymentType($rtgsType, $today);
        foreach ($rtgs as $rtgsRow) {
            $rtgsAmount += $rtgsRow['price'];
        }
        ?>
        <div class="card shadow-sm pt-2 border-bottom-secondary">
            <div class="card-body">
                <span>Totals (Per Rate)</span>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>USD</th>
                        <th>ZAR</th>
                        <th>BOND</th>
                        <th>RTGS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>$<?= $usdAmount ?></td>
                        <td>$<?= $zarAmount ?></td>
                        <td>$<?= $bondAmount ?></td>
                        <td>$<?= $rtgsAmount ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }

    public function viewDuplicateRemover(){
        $mainRows = $this->GetAllChildStockTake();
        $column = 'uid';
        $rows2 = $this->duplicateRemover($mainRows, $column);
        foreach ($rows2 as $row2){
            echo $row2['uid'] . '<br>';
        }
    }

    public function viewDailyReport($day){
        $today = '%'.$day.'%';
        $rows = $this->GetPaymentsByDate($today);
        ?>

        <div class="alert alert-info">
            <span class="mb-3">Report Date: <span class="text-dark"><b><?= $this->dateToDay($day) ?></b></span></span>
        </div>

        <?php
        $this->viewAmountByPaymentType($day);
        ?>

        <div class="-d-flex -justify-content-between col-md-12 pt-4 shadow-sm">
            <table class="table table-bordered" id="dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>TransID(Name)</th>
                    <th>Quantities</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $s=0;
                foreach ($rows as $row) {
                    $stockRows = $this->GetStockByID($row['itemID']);
                    if(count($stockRows) > 0){
                        $itemName = $row['transactionID']  .'('.$stockRows[0]['name'] .')';
                    }else{
                        $itemName = $row['transactionID'];
                    }
                    ?>
                    <tr>
                        <td><?= $s+=1 ?></td>
                        <td><?= $itemName ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= $row['paymentType'] ?></td>
                        <td>$<?= $row['price'] ?></td>
                        <td><?= $this->dateTimeToDay($row['dateAdded']) ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function viewStockTakeReport($uid){
        $stockTakeMainRows = $this->GetStockTakeMainByUID($uid);
        if(count($stockTakeMainRows) > 0){
            $stockTakeChildRows = $this->GetStockTakeChildByUID($uid);


            $defaultCntr = new DefaultContr();
            $userRows = $defaultCntr->GetUserByID($stockTakeMainRows[0]['addedBY']);
            if(count($userRows) > 0){
                $isUser = $defaultCntr->isUser($userRows[0]['id'], $userRows[0]['role']);
                $by = $isUser[0]['name'] .' ' . $isUser[0]['surname'];
                $byID = $isUser[0]['userID'];
            }else{
                $by = 'user account not found/deleted';
                $byID = '';
            }

            //itemsSold, Profits made,
            $totalItemsSold = 0;
            $totalProfitsMade = 0;
            $itemDifference = 0;
            $totalMoneyDef = 0;
            foreach ($stockTakeChildRows as $stockTakeChildRowItemsSold){
                $totalItemsSold += $stockTakeChildRowItemsSold['stockDBNetQuantity'] - $stockTakeChildRowItemsSold['stockDBGrossQuantity'];
                $totalProfitsMade +=  ($stockTakeChildRowItemsSold['stockDBNetQuantity'] - $stockTakeChildRowItemsSold['stockDBGrossQuantity']) * ($stockTakeChildRowItemsSold['stockSellingPrice'] - $stockTakeChildRowItemsSold['stockBuyingPrice']);
                $itemDifference += $stockTakeChildRowItemsSold['stockPhysicalQuantity'] - $stockTakeChildRowItemsSold['stockDBGrossQuantity'];
                $totalMoneyDef += ($stockTakeChildRowItemsSold['stockSellingPrice'] - $stockTakeChildRowItemsSold['stockBuyingPrice']) * ($stockTakeChildRowItemsSold['stockPhysicalQuantity'] - $stockTakeChildRowItemsSold['stockDBGrossQuantity']);
            }

            $shortfallDec = 0;
            $surplusDec = 0;
            $balancedDec = 0;
            if($itemDifference > 0 || $totalMoneyDef > 0){
                $surplusDec = 1;
                $totalBg = 'primary';
            }elseif ($itemDifference < 0  || $totalMoneyDef < 0){
                $shortfallDec = 1;
                $dec = 1;
                $totalBg = 'danger';
            }else{
                $balancedDec = 1;
                $dec = 1;
                $totalBg = 'success';
            }

            ?>

            <div class="col-md-12 pb-5">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="underline">Overall Stock Take Report</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <p><u>Stock Take Details</u></p>
                                <span> <span class="font-weight-bold p-1">UID: </span> <span><?= $uid ?></span> </span><br>
                                <span> <span class="font-weight-bold p-1">Date: </span> <span><?= $this->dateTimeToDay($stockTakeMainRows[0]['dateAdded']) ?></span> </span><br>
                                <hr>
                                <span><span class="font-weight-bold p-1">By: </span><span><a href="userProfile.php?userID=<?= $byID ?>"><?= $by ?> </a></span> </span>
                                <span> <span> </span> <span></span> </span>
                            </div>
                            <div class="col-md-6">
                                <p><u>Total Stock Take Product Summery</u></p>
                                <span> <span class="font-weight-bold p-1">Total Products Recorded: </span> <span><?= count($stockTakeChildRows) ?> Products</span> </span><br>
                                <span> <span class="font-weight-bold p-1">Total Product Items Sold: </span> <span><?= $totalItemsSold ?> items</span> </span><br>
                                <span> <span class="font-weight-bold p-1">Total Profit Made: </span> <span>$<?= $totalProfitsMade ?></span> </span><br>
                                <br>
                                <?php
                                if($shortfallDec == 1){
                                    ?>
                                    <span class="text-<?= $totalBg ?>"> <span class="font-weight-bold p-1">Shortfall -</span>
                                        <span> :
                                            <ul>
                                                <li class="badge badge-<?= $totalBg ?>">Items : <?= $itemDifference ?></li>
                                                <li class="badge badge-<?= $totalBg ?>">Shortfall Amount : $<?= $totalMoneyDef ?></li>
                                            </ul>
                                        </span>
                                    </span><br>
                                    <?php
                                }
                                ?>

                                <?php
                                if($surplusDec == 1){
                                    ?>
                                    <span class="text-<?= $totalBg ?>"> <span class="font-weight-bold p-1">Surplus +</span>
                                        <span> :
                                            <ul>
                                                <li class="badge badge-<?= $totalBg ?>">Items : <?= $itemDifference ?></li>
                                                <li class="badge badge-<?= $totalBg ?>">Surplus Amount : $<?= $totalMoneyDef ?></li>
                                            </ul>
                                        </span>
                                    </span><br>
                                    <?php
                                }
                                ?>

                                <?php
                                if($balancedDec == 1){
                                    ?>
                                    <span class="text-<?= $totalBg ?>"> <span class="font-weight-bold p-1">Account Balanced </span>
                                        <span> :
                                            <ul>
                                                <li class="badge badge-<?= $totalBg ?>">Item Difference: <?= $itemDifference ?></li>
                                                <li class="badge badge-<?= $totalBg ?>">Surplus/Shortfall Amount : $<?= $totalMoneyDef ?></li>
                                            </ul>
                                        </span>
                                    </span><br>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h5>Individual Product Statistics</h5>
            <div class="row">
                <?php
                $s=0;
                foreach ($stockTakeChildRows as $stockTakeChildRow){
                    $itemDifference = $stockTakeChildRow['stockPhysicalQuantity'] - $stockTakeChildRow['stockDBGrossQuantity'];
                    $moneyProfit = $stockTakeChildRow['stockSellingPrice'] - $stockTakeChildRow['stockBuyingPrice'];
                    $moneyDifference = $moneyProfit * $itemDifference;
                    $sold = $stockTakeChildRow['stockDBNetQuantity'] - $stockTakeChildRow['stockDBGrossQuantity'];
                    if($sold > 0){
                        $profit = 'Profit Made: $' . $sold * $moneyProfit;
                    }else{
                        $profit = '';
                    }
                    if($stockTakeChildRow['stockDBGrossQuantity'] > $stockTakeChildRow['stockPhysicalQuantity']){
                        //Shortfall
                        $moneyDes = 'Shortfall amount: ';
                        $msg = 'Shortfall ' . $itemDifference . ' items';
                        $bg = 'danger';
                    }elseif ($stockTakeChildRow['stockDBGrossQuantity'] < $stockTakeChildRow['stockPhysicalQuantity']){
                        //surplus
                        $moneyDes = 'Surplus amount: ';
                        $msg = 'Surplus +' . $itemDifference . ' items';
                        $bg = 'primary';
                    }else{
                        //balanced
                        $moneyDes = 'Balanced: ';
                        $msg = 'Balanced';
                        $bg = 'success';
                    }
                    ?>
                    <div class="col-md-4 p-1">
                        <div style="font-size: 14px" class="card border border-<?= $bg ?>">
                            <span class="badge badge-<?= $bg ?>"><?= $s+=1 ?></span>
                            <div class="card-body">
                                <div --class="alert bg-<?= $bg ?>">
                                    <span class="font-weight-bold text-center"></span>
                                </div>
                                <div class="text-center h5"><?= $stockTakeChildRow['stockName']; ?></div>
                                <hr>
                                <div class="row border-bottom-secondary pb-1">
                                    <div class="col-md-6">
                                        <span class="font-weight-bold">Opening DB Quantity : </span><span><?= $stockTakeChildRow['stockDBNetQuantity']; ?></span><br>
                                        <span class="font-weight-bold">Closing DB Quantity : </span><span> <?= $stockTakeChildRow['stockDBGrossQuantity']; ?></span><br>
                                        <span class="font-weight-bold">Physical Quantity : </span><span><?= $stockTakeChildRow['stockPhysicalQuantity']; ?></span><br>
                                    </div>
                                    <div class="col-md-6 border-left-secondary">
                                        <span class="font-weight-bold">Report</span><br>
                                        <span>Sold: <?= $sold ?> items</span><br>
                                        <span>Status: <?= $msg ?></span><br>
                                        <span><?= $moneyDes ?>  $<?= $moneyDifference ?></span><br>
                                    </div>
                                </div>
                                <div class="row pt-2">
                                    <div class="col-md-4">selling price: $<?= $stockTakeChildRow['stockSellingPrice'] ?></div>
                                    <div class="col-md-4">buying price: $<?= $stockTakeChildRow['stockBuyingPrice'] ?></div>
                                    <div class="col-md-4"><?= $profit ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }else{
            ?>
            <div class="card">
                <div class="card-body">
                    <div class="alert bg-warning text-dark text-center">Something went wrong. Please make sure the link is correct or contact the admin if the problem persist</div>
                </div>
            </div>
            <?php
        }
    }


    public function viewPendingStockTakeChildLoop($uid){
        $status = 0;
        $rows = $this->GetPendingMainStockTakeByStatusAndUID($status, $uid);
        ?>
        <p class="mb-3">Stock Take</p>
        <div class="-d-flex -justify-content-between col-md-12">
            <table class="table table-bordered" id="dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $s = 0;
                foreach ($rows as $row){
                    ?>
                    <tr>
                        <td><?= $s+=1 ?></td>
                        <td> <a href="stocktake.php?uid=<?= $uid ?>&stockProductID=<?= $row['id'] ?>"><?= $row['stockName'] ?></a></td>
                    </tr>
                    <?php
                }
                ?>

                </tbody>
            </table>
        </div>
        <?php
    }

    public function viewStockTake($uid){
        $rows = $this->GetStockTakeChildByUID($uid);
        ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <?php $this->viewPendingStockTakeChildLoop($uid) ?>
                    </div>
                </div>
            </div>

            <?php
            if(count($this->GetPendingMainStockTakeByStatusAndUID(0, $uid)) <= 0 ){
                //Update Main Stock Take table status to one to remove the pending status
                $this->updatestockMainStatus($uid);
                $this->updateStockToPhysicalQuantities($uid);
                ?>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert bg-success text-white text-center">Stock take session is complete and all details have been recorded. Proceed to view Stock the Report</div>
                            <div class="text-center"><a href="stockReport.php?uid=<?= $uid ?>">View Stock Report</a></div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            <?php
            if(isset($_GET['stockProductID'])){
                $stockProductRows = $this->GetStockTakeChildByIDANDUID($_GET['stockProductID'], $uid);
                ?>

                <div class="col-md-6">

                    <table style="" class="table table-bordered pb-4">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Buying Price</th>
                            <th>Selling Price</th>
                            <th>Opening</th>
                            <th>Closing</th>
                            <th>Sold</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= $stockProductRows[0]['stockName'] ?></td>
                            <td>$<?= $stockProductRows[0]['stockBuyingPrice'] ?></td>
                            <td>$<?= $stockProductRows[0]['stockSellingPrice'] ?></td>
                            <td><?= $stockProductRows[0]['stockDBNetQuantity'] ?></td>
                            <td><?= $stockProductRows[0]['stockDBGrossQuantity'] ?></td>
                            <td><?= $stockProductRows[0]['stockDBNetQuantity'] - $stockProductRows[0]['stockDBGrossQuantity'] ?></td>
                        </tr>
                        </tbody>
                    </table>



                    <div class="pt-3">
                        <form method="POST" action="../includes/update.inc.php">
                            <label>Enter Current Physical Quantities For : <?= $stockProductRows[0]['stockName'] ?></label><br>

                            <div class="form-row">
                                <input name="pid" value="<?= $stockProductRows[0]['id'] ?>" hidden>
                                <input name="uid" value="<?= $uid ?>" hidden>
                                <div class="col-md-6">
                                    <input class="form-control" type="number" name="PhysicalQuantities" placeholder="Current Physical Products Left..." required >
                                </div>

                                <div class="col-md-6">
                                    <button name="btn_updateProductStockTake" class="btn btn-sm btn-outline-success" type="submit"> Record </button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>

                <?php
            }
            ?>


        </div>

        <?php
    }


    public function stockTakeMainLoop(){
        $status = 1;
        $rows = $this->GetPendingMainStockTakeByStatus($status);
        $s=0;
        ?>
        <p class="mb-3">All Stock Take Reports</p>
        <div class="-d-flex -justify-content-between col-md-12">
            <table class="table table-bordered" id="dataTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>UID</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($rows as $row){
                    ?>
                    <tr>
                        <td><?= $s+=1 ?></td>
                        <td><a href="stockReport.php?uid=<?= $row['uid'] ?>"><?= $row['uid'] ?></a></td>
                        <td><?= $this->dateToDay($row['dateAdded']) ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <?php
    }


    public function viewAllSTockTakes(){
        $rows = $this->GetAllMainStockTake();
        $s = 0;
        $pending = 0;
        foreach ($rows as $row){
            $s+=1;
            if($row['status'] == 0){
                $pending++;
            }else{
                $pending = $pending + 0;
            }
        }

        if($pending > 0){
            //THere is an ongoing stocktake
            $status = 0;
            $pendingRows = $this->GetPendingMainStockTakeByStatus($status);
            ?>
            <div class="alert alert-warning">
                <span class="fa fa-exclamation-triangle"></span>
                There is a pending/ongoing stock take <a class="btn btn-outline-dark btn-sm" href="stocktake.php?uid=<?= $pendingRows[0]['uid'] ?>"><?= $pendingRows[0]['uid'] ?> (<?= $pendingRows[0]['dateAdded'] ?>) <span class="fa fa-chevron-circle-right"></span></a>
            </div>

            <?php
        }else{
            //no stocktake available
            ?>
            <br>
            <a onclick="return confirm('You are about to start a new stock take session. NOTE: Opening stock inventory for each product will be updated to match physical inventory that you are going to capture. Proceed anyway?')" href="../includes/additional.inc.php?action=newStockTake" class="btn btn-outline-primary btn-sm"> New Stock take <span class="fa fa-chevron-circle-right"></span></a>
            <?php
        }

        ?>
        <br>
        <br>
        <hr>
        <?php
        $this->stockTakeMainLoop();
    }


    public function viewAllPricesTable(){
        $cashRate = $this->GetRatesByCurrency('bond');
        $rtgsRate = $this->GetRatesByCurrency('rtgs');
        $zarRate = $this->GetRatesByCurrency('zar');
        ?>

        <hr>

        <p class="mb-3">Payment Rates</p>
        <div class="d-flex justify-content-between">
            <table class="table table-bordered" -id="dataTable">
                <thead>
                <tr>
                    <th>Usd</th>
                    <th>Bond</th>
                    <th>Rtgs</th>
                    <th>Zar</th>
                </tr>
                </thead>
                <td>$<?= $this->GetCartArtPriceByID($_SESSION['transactionID']); ?></td>
                <td>$<?= $cashRate[0]['rate'] * $this->GetCartArtPriceByID($_SESSION['transactionID']); ?></td>
                <td>$<?= $rtgsRate[0]['rate'] * $this->GetCartArtPriceByID($_SESSION['transactionID']); ?></td>
                <td>$<?= $zarRate[0]['rate'] * $this->GetCartArtPriceByID($_SESSION['transactionID']); ?></td>
                <tbody>
                </tbody>
            </table>
        </div>
        <?php
    }

    public function viewSetRates($currency){
        $rows = $this->GetRatesByCurrency($currency);
        foreach ($rows as $row){
            ?>
            <div class="border-left-success rounded shadow-sm">
                <form method="POST" action="../includes/update.inc.php">
                    <div class="card pt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <b>Currency: </b><lable><?= $row['currency'] ?><br> (usd $1 = <?= $row['currency'] .' $'. $row['rate'] ?>)</lable>
                                </div>
                                <input name="currency" value="<?= $row['currency'] ?>" hidden>
                                <div class="col-md-4">
                                    <input name="rate" value="<?= $row['rate'] ?>"  class="form-control" type="number" placeholder="Please Provide current rate for <?= $row['currency'] ?>/usd rate" required>
                                </div>
                                <div class="col-md-3">
                                    <button type="reset" class="btn btn-warning btn-sm"><span class="fa fa-times-circle"></span></button>
                                    <button name="btn_update_rate" type="submit" onclick="return confirm('Update <?= $row['currency'] ?> rate?')" class="btn btn-primary btn-sm">Update <?= $row['currency'] ?></button>
                                </div>
                                <div class="col-md-3">
                                    <label>Last Update: <?= $this->timeAgo($row['lastUpdated']) ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php
        }
    }

    public function viewAddManually($itemID){
        $rows = $this->GetStockByID($itemID);
        if(count($rows) > 0){
            ?>
            <div class="card">
                <form method="post" action="../includes/insert.inc.php">
                    <div class="modal-body">
                        <div class="-modal-header">
                            <h5>Purchase Details</h5>
                        </div>
                        <hr>
                        <div class="form-row row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4" class="col-form-label">Name</label>
                                <input name="name" value="<?= $rows[0]['name'] ?>" type="text" class="form-control" placeholder="Stock Supply Name" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4" class="col-form-label">BarCode</label>
                                <input name="barCode" value="<?= $rows[0]['barCode'] ?>" type="number" class="form-control" placeholder="Barcode |||||" disabled>
                            </div>
                        </div>

                        <?php
                        $cashRate = $this->GetRatesByCurrency('bond');
                        $rtgsRate = $this->GetRatesByCurrency('rtgs');
                        $zarRate = $this->GetRatesByCurrency('zar');
                        ?>

                        <p class="mb-3">Price & Rates (each item)</p>
                        <div class="d-flex justify-content-between">
                            <table class="table table-bordered" -id="dataTable">
                                <thead>
                                <tr>
                                    <th>Usd</th>
                                    <th>Bond</th>
                                    <th>Rtgs</th>
                                    <th>Zar</th>
                                </tr>
                                </thead>
                                <td>$<?= $rows[0]['sellingPrice'] ?></td>
                                <td>$<?= $cashRate[0]['rate'] * $rows[0]['sellingPrice'] ?></td>
                                <td>$<?= $rtgsRate[0]['rate'] * $rows[0]['sellingPrice'] ?></td>
                                <td>$<?= $zarRate[0]['rate'] * $rows[0]['sellingPrice'] ?></td>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <hr>
                        <div class="form-row row">
                            <div class="col-md-6">
                                <label>Payment Method Used</label>
                                <select name="currency" class="form-control form-select" required>
                                    <option value="">-- Select Payment Method --</option>
                                    <option value="usd">Cash USD</option>
                                    <option value="bond">Cash BOND</option>
                                    <option value="zar">Cash ZAR</option>
                                    <option value="ecocash rtgs">Rtgs ECOCASH</option>
                                    <option value="card rtgs">Rtgs CARD</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Quantities Sold</label>
                                <input name="quantity" type="number" min="1" class="form-control" placeholder="Quantity Sold" required>
                            </div>
                            <input value="<?= $_GET['itemID'] ?>" name="itemID" hidden>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <a href="manualAdd.php" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times-circle"></span></a>
                        <button onclick="return confirm('Are you sure you entered the right quantity and currency?')" name="btn_manual_add_Stock" type="submit"  class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <?php
        }else{
            ?>
            <div>
                <div class="alert alert-danger">Stock not found</div>
            </div>
            <?php
        }
    }


    public function viewCategoryOptionLoop(){
        $rows = $this->GetAllCategories();
        foreach ($rows as $row){
            ?>
            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
            <?php
        }
    }


    public function GetCartArtPriceByID($id){
        $rows = $this->GetCartByTransactionID($id);
        $price = 0;
        foreach ($rows as $row){
            $price += $row['price'];
        }
        if($price == NULL || $price <= 0){
            echo '00.00';
        }
        else {
            //echo $price;
            return $price;
        }
    }

    public function viewCartCount($id){
        $rows = $this->GetCartByTransactionID($id);
        echo count($rows);
    }

    public function viewCartItemCount($id){
        $rows = $this->GetCartByTransactionID($id);
        $items = 0;
        foreach ($rows as $row){
            $items += $row['quantity'];
        }
        echo $items;
    }

    public function cartLoop($id){
        $rows = $this->GetCartByTransactionID($id);
        if(count($rows) > 0)
        {
            foreach ($rows as $rowcart)
            {
                $itemID = $rowcart['itemID'];
                $itemRows = $this->GetStockByID($itemID);
                $total = $rowcart['quantity'] * $itemRows[0]['sellingPrice'];
                ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center">
                                <div class="ms-3">
                                    <h5><?php echo $itemRows[0]['name'] ?></h5>
                                    <p class="small mb-0"><?php echo $rowcart['quantity'] ?> <?php echo $itemRows[0]['name'] ?> items ($<?php echo  $itemRows[0]['sellingPrice'] ?> each)</p>
                                    <p class="small mb-0"><b>
                                            <?php
                                            $cashRate = $this->GetRatesByCurrency('bond');
                                            $rtgsRate = $this->GetRatesByCurrency('rtgs');
                                            $zarRate = $this->GetRatesByCurrency('zar');
                                            ?>
                                            bond: $<?= $cashRate[0]['rate'] * $itemRows[0]['sellingPrice'] ?> |
                                            rtgs: $<?= $rtgsRate[0]['rate'] * $itemRows[0]['sellingPrice'] ?> |
                                            zar: $<?= $zarRate[0]['rate'] * $itemRows[0]['sellingPrice'] ?>
                                        </b>
                                    </p>

                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <div style="width: 80px;">

                                    Total: $<?= $total ?>
                                </div>
                            </div>
                            <a onclick="return confirm('Are you sure you want to remove from cart?');" href="../includes/delete.inc.php?delCart&itemID=<?php echo $rowcart['id'] ?>" class="fa fa-trash-alt"></a>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        else{
            ?>
            <div class="animated--grow-in fadeout -my-3 -p-3 bg-white rounded shadow-sm alert alert-warning">
                No items in this cart
            </div>
            <?php
        }
    }


    public function viewCart($id){
        $rows = $this->GetCartByTransactionID($id);
        ?>
        <section class="h-100 h-custom" -style="background-color: #eee;">Cart
            <div class="container py-4 h-100">
                <div -class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col">
                        <div class="card">
                            <div class="card-body -p-4">

                                <div class="row">

                                    <div class="col-lg-12">
                                        <h5 class="mb-3">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="../includes/additional.inc.php?action=newTransaction" class="btn btn-outline-danger">
                                                        <i class="fa fa-times-circle"></i>
                                                        Cancel
                                                    </a>
                                                </div>
                                                <div style="font-size: 13px" class="col-md-6">
                                                    <a href="#!" -class="text-body">
                                                        Transaction ID: <?php echo $_SESSION['transactionID'] ?>
                                                    </a>
                                                </div>
                                            </div>

                                        </h5>

                                        <hr>

                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div>
                                                <p class="mb-1">Shopping cart</p>
                                                <p class="mb-0">There are
                                                    <?php
                                                    $cartc = new UserView();
                                                    $cartc->viewCartCount($id);
                                                    ?>
                                                    Product/s in this transaction cart</p>
                                            </div>
                                        </div>

                                        <?php
                                        $cl = new UserView();
                                        $cl->cartLoop($id);
                                        ?>



                                    </div>
                                    <div class="col-lg-12">

                                        <div class="card bg-primary text-white rounded-3">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-4">
                                                    <h5 class="mb-0">Payment Checkout</h5>
                                                </div>

                                                <hr class="my-4">


                                                <div class="d-flex justify-content-between">
                                                    <p class="mb-2">Total Product Items</p>
                                                    <p class="mb-2">
                                                        <?php
                                                        $this->viewCartItemCount($_SESSION['transactionID']);
                                                        ?>
                                                    </p>
                                                </div>

                                                <?php
                                                $cashRate = $this->GetRatesByCurrency('bond');
                                                $rtgsRate = $this->GetRatesByCurrency('rtgs');
                                                $zarRate = $this->GetRatesByCurrency('zar');
                                                ?>

                                                <hr>

                                                <p class="mb-3">Total Amount</p>
                                                <div class="d-flex justify-content-between">

                                                    <p class="mb-2">
                                                    <table class="text-white table table-bordered" -id="dataTable" width="100%" cellspacing="0">
                                                        <thead>
                                                        <tr>
                                                            <th>Usd</th>
                                                            <th>Bond</th>
                                                            <th>Rtgs</th>
                                                            <th>Zar</th>
                                                        </tr>
                                                        </thead>
                                                        <td>$<?= $this->GetCartArtPriceByID($_SESSION['transactionID']); ?></td>
                                                        <td>$<?= $cashRate[0]['rate'] * $this->GetCartArtPriceByID($_SESSION['transactionID']); ?></td>
                                                        <td>$<?= $rtgsRate[0]['rate'] * $this->GetCartArtPriceByID($_SESSION['transactionID']); ?></td>
                                                        <td>$<?= $zarRate[0]['rate'] * $this->GetCartArtPriceByID($_SESSION['transactionID']); ?></td>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                    </p>
                                                </div>
                                                <hr>

                                                <?php
                                                $rr = $this->GetCartArtPriceByID($_SESSION['transactionID']);
                                                if($rr > 0){
                                                    ?>
                                                    <a href="payNow.php" type="button" class="btn btn-info btn-block btn-lg">
                                                        <div class="d-flex justify-content-between">
                                                            <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <a href="#!" type="button" class="btn btn-warning btn-block btn-lg">
                                                        <div class="d-flex justify-content-between">
                                                        <span>
                                                            cart is empty
                                                        </span>
                                                        </div>
                                                    </a>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }

    public function viewAddCart($itemID){
        $itemRows = $this->GetStockByID($itemID);
        ?>
        <br>
        <br>
        <div class="card">
            <div class="card-body">
                <div class="-modal-header">
                    <h5>Cart: <?php echo $itemRows[0]['name'] ?></h5>
                </div>
                <hr>
                <form method="POST" action="../includes/insert.inc.php">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Choose Quantity</label>
                            <input name="price" value="<?php echo $itemRows[0]['sellingPrice'] ?>" hidden>
                            <input name="itemID" value="<?php echo $itemID ?>" hidden>
                            <input name="quantity" type="number" class="form-control" min="1" max="<?php echo $itemRows[0]['quantity'] ?>" placeholder="quantity..." required>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <a onclick="return history.back(-1);" class="btn btn-warning"><span class="fa fa-times-circle"></span></a>
                                </div>
                                <div class="col-md-6">
                                    <button name="btn_addToCart" class="btn btn-primary" type="submit"><span class="fa fa-plus-circle"></span></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <?php
                            $cashRate = $this->GetRatesByCurrency('bond');
                            $rtgsRate = $this->GetRatesByCurrency('rtgs');
                            $zarRate = $this->GetRatesByCurrency('zar');
                            ?>

                            <label>Prices/(each)</label>
                            <div class="d-flex justify-content-between">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Usd</th>
                                        <th>Bond</th>
                                        <th>Rtgs</th>
                                        <th>Zar</th>
                                    </tr>
                                    </thead>
                                    <td>$<?= $itemRows[0]['sellingPrice'] ?></td>
                                    <td>$<?= $cashRate[0]['rate'] * $itemRows[0]['sellingPrice'] ?></td>
                                    <td>$<?= $rtgsRate[0]['rate'] * $itemRows[0]['sellingPrice'] ?></td>
                                    <td>$<?= $zarRate[0]['rate'] * $itemRows[0]['sellingPrice'] ?></td>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }

    public function viewAllPurchaseHistory(){
        $rows = $this->GetAllPayments();
        $s = 0;

        foreach ($rows as $row)
        {
            $itemRows = $this->GetStockByID($row['itemID']);
            $s++;

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

    }

    public function overallStats(){
        $rows = $this->GetAllStock();

        $totalInv = 0;
        $soldItems = 0;
        $remainingItems = 0;
        $newDBuyingPrice = 0;
        $newDSellingPrice = 0;
        $currentSoldItemsBuyingPrice = 0;
        $currentSoldItemsSellingPrice = 0;

        foreach ($rows as $row) {
            //Masx
            $totalInv = $totalInv + $row['newDQuantity'];
            $remainingItems = $remainingItems + $row['quantity'];
            $soldItems = $soldItems + $row['newDQuantity'] - $row['quantity'];
        }

        foreach ($rows as $row){
            //ExpectedProfitStatsCalx
            $newDBuyingPrice += $row['newDBuyingPrice'] * $row['newDQuantity'];
            $newDSellingPrice += $row['newDSellingPrice'] * $row['newDQuantity'];
            $totalExpProfit = $newDSellingPrice - $newDBuyingPrice;
        }
        foreach ($rows as $row){
            //CurrentProfitStatsCalx
            $currentSoldItemsBuyingPrice += ($row['newDQuantity'] - $row['quantity']) * $row['newDBuyingPrice'];
            $currentSoldItemsSellingPrice += ($row['newDQuantity'] - $row['quantity']) * $row['newDSellingPrice'];
            $currentProfit = $currentSoldItemsSellingPrice - $currentSoldItemsBuyingPrice;
        }


        ?>
        <div class="row">
            <div class="col-md-4 card">
                <div class="page-title-wrapper card-body">
                    <div class="page-title-heading">
                        <strong>Statistics</strong>
                        <br>
                        <br>
                        <div class="pb-2">
                            Opening Stock Products: <?php echo count($rows) ?><br>
                        </div>
                        <div class="pb-2">
                            Opening Stock Product Items quantity:  <strong>(<?php echo $totalInv ?> items)</strong>
                        </div>
                        <div class="pb-2">
                            Current Product Items Quantity: <?php echo $remainingItems ?>
                        </div>
                        <div class="pb-2">
                            Sold Prouct Items: <?php echo $soldItems ?>
                        </div>
                    </div>
                </div>
                <!--<hr>
                <div -class="d-block clearfix card-footer">
                    <div class="float-left">
                        <a href="../includes/update.inc.php?newDay" onclick="return confirm('This will reset all items purchase history and statistics, continue?')" class="mr-2 btn-icon btn-icon-only btn btn-outline-info btn-sm">New Day <span class="fa fa-retweet"></span> </a>
                    </div>
                </div>-->
                <br>
            </div>

            <div class="col-md-4 card">
                <div class="page-title-wrapper card-body">
                    <div class="page-title-heading">
                        <strong>Profits</strong>
                        <br>
                        <br>
                        <div class="pb-2">
                            Total Stock Buying Price : $<?php echo $newDBuyingPrice ?> </strong>
                        </div>
                        <div class="pb-2">
                            Total Stock Selling Price : $<?php echo $newDSellingPrice ?> </strong>
                        </div>
                        <div class="pb-2">
                            Total Sold Product Items Buying Price: $<?php echo $currentSoldItemsBuyingPrice ?>
                        </div>
                        <div class="pb-2">
                            Total Sold Product Items Selling Price: $<?php echo $currentSoldItemsSellingPrice ?>
                        </div>
                        <div class="pb-2">
                            <?php
                            if(!isset($currentProfit)){
                                ?>
                                current Profit: $ : $ 0.00
                                <?php
                            }
                            else{
                                ?>
                                current Profit: $<?php echo $currentProfit ?> </strong>
                                <?php
                            }
                            ?>
                        </div>


                        <div class="pb-2 alert alert-info">
                            <?php
                            if(!isset($totalExpProfit)){
                                ?>
                                Total Expected Profit : $ 0.00
                                <?php
                            }
                            else{
                                ?>
                                Total Expected Profit : $<?php echo $totalExpProfit ?> </strong>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 card">
                <?php
                $cashRate = $this->GetRatesByCurrency('bond');
                $rtgsRate = $this->GetRatesByCurrency('rtgs');
                $zarRate = $this->GetRatesByCurrency('zar');
                ?><br>
                <b>Current Profit in</b>
                <ul>
                    <li>Cash : $<?= $cashRate[0]['rate'] * $currentProfit ?></li>
                    <li>Rtgs : $<?= $rtgsRate[0]['rate'] * $currentProfit ?></li>
                    <li>Zar : $<?= $zarRate[0]['rate'] * $currentProfit ?></li>
                </ul>
                <hr>
                <b>Total Expected Profit in</b>
                <ul>
                    <li>Cash : $<?= $cashRate[0]['rate'] * $totalExpProfit ?></li>
                    <li>Rtgs : $<?= $rtgsRate[0]['rate'] * $totalExpProfit ?></li>
                    <li>Zar : $<?= $zarRate[0]['rate'] * $totalExpProfit ?></li>
                </ul>
            </div>
        </div>
        <?php
    }

    public function viewStockDetails($id){
        $rows = $this->GetStockByID($id);
        if(count($rows) > 0){
            ?>

            <div class="mt-4 mb-4">
                <div class="row">
                    <div class="col-md-6 card">
                        <div class="page-title-wrapper card-body">
                            <div class="page-title-heading">
                                <div>
                                    <strong>Item:</strong><br>
                                    <?php echo $rows[0]['name'] ?>:  <strong>(<?php echo $rows[0]['quantity'] ?>)</strong>
                                    <div class="page-title-subheading">BarCode: <?php echo $rows[0]['barCode'] ?></div>
                                    <div class="page-title-subheading">Category:
                                        <?php
                                        $categRows = $this->GetCategoryByID($rows[0]['category']);
                                        if(count($categRows) > 0){
                                            echo $categRows[0]['name'];
                                        }else{
                                            echo '<i>empty</i>';
                                        }
                                        ?>
                                    </div>
                                    <hr>
                                    <strong>Prices:</strong>
                                    <br>
                                    Selling @ $<span><?php echo $rows[0]['sellingPrice'] ?></span> | Bought @ $<span><?php echo $rows[0]['buyingPrice'] ?></span>
                                    <hr>
                                    <div>
                                        <strong>Selling Rate Price (<span style="font-size: 12px">each item</span>):</strong>
                                        <?php
                                        $cashRate = $this->GetRatesByCurrency('bond');
                                        $rtgsRate = $this->GetRatesByCurrency('rtgs');
                                        $zarRate = $this->GetRatesByCurrency('zar');
                                        ?><br>
                                        Bond : $<?= $cashRate[0]['rate'] * $rows[0]['sellingPrice'] ?><br>
                                        Rtgs : $<?= $rtgsRate[0]['rate'] * $rows[0]['sellingPrice'] ?><br>
                                        Zar : $<?= $zarRate[0]['rate'] * $rows[0]['sellingPrice'] ?>
                                    </div>
                                    <hr>
                                    <div class="page-title-subheading">Added: <?php echo $this->dateToDay($rows[0]['dateAdded']) ?> (<?php echo $this->timeAgo($rows[0]['dateAdded']) ?>)</div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div -class="d-block clearfix card-footer">
                            <div class="float-left">
                                <a href="../includes/delete.inc.php?delStock&delItem=<?php echo $id ?>" onclick="return confirm('Are you sure you want to remove this product from stock?')" class="mr-2 btn-icon btn-icon-only btn btn-outline-danger btn-sm">Delete</a>
                            </div>
                        </div>
                        <br>
                    </div>

                    <div class="col-md-6 card">
                        <div class="card-body">
                            <strong>Statistics</strong>
                            <div class="pb-2">
                                Total Items(<?php echo $rows[0]['name'] ?>) :
                                <?php
                                echo $rows[0]['newDQuantity'];
                                ?>
                            </div>

                            <div class="pb-2">
                                Current Items(<?php echo $rows[0]['name'] ?>) :
                                <?php
                                echo $rows[0]['quantity'];
                                ?>
                            </div>

                            <div class="pb-2">
                                Total Buying Price:
                                <?php
                                echo '$' . $rows[0]['newDBuyingPrice'] * $rows[0]['newDQuantity'];
                                ?>
                            </div>

                            <div class="pb-2">
                                Total Selling Price:
                                <?php
                                echo '$' . $rows[0]['newDSellingPrice'] * $rows[0]['newDQuantity'];
                                ?>
                            </div>
                            <hr>
                            <strong>Profits</strong>
                            <div class="pb-2">
                                Items(<?php echo $rows[0]['name'] ?>) Sold :
                                <?php
                                echo $rows[0]['newDQuantity'] - $rows[0]['quantity']
                                ?>
                            </div>

                            <div class="pb-2">
                                Total Sold Items(<?php echo $rows[0]['name'] ?>) Buying Price:
                                $<?php
                                echo ($rows[0]['newDQuantity'] - $rows[0]['quantity']) * $rows[0]['newDBuyingPrice'];
                                ?>
                            </div>

                            <div class="pb-2">
                                Total Sold Items(<?php echo $rows[0]['name'] ?>) Selling Price:
                                $<?php
                                echo ($rows[0]['newDQuantity'] - $rows[0]['quantity']) * $rows[0]['newDSellingPrice'];
                                ?>
                            </div>

                            <div class="pb-2">
                                Current Profit:
                                <?php
                                $currentStock = $rows[0]['newDQuantity'] - $rows[0]['quantity'];
                                $cBuyingPrice = $currentStock * $rows[0]['newDBuyingPrice'];
                                $cSellingPrice = $currentStock * $rows[0]['newDSellingPrice'];
                                $profitCurrent = $cSellingPrice - $cBuyingPrice;
                                echo '$' . $profitCurrent;
                                ?>
                            </div>

                            <br>

                            <div class="pb-2 alert alert-info">
                                Total Expected Profit:
                                <?php
                                $buyingPrice = $rows[0]['newDBuyingPrice'] * $rows[0]['newDQuantity'];
                                $sellingPrice =  $rows[0]['newDSellingPrice'] * $rows[0]['newDQuantity'];
                                $profit = $sellingPrice - $buyingPrice ;
                                echo '$' . $profit;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>


                <br>
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        <div>
                            <h5 class="menu-header-title text-capitalize text-primary">Update <?php echo $rows[0]['name'] ?></h5>
                        </div>
                    </div>
                    <br>
                    <form method="POST" action="../includes/update.inc.php" class="form pb-2">
                        <div class="col-md-6">
                            <input name="itemID" value="<?php echo $id ?>" hidden>

                            <div class="form-row row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Name</label>
                                    <input name="name" type="text" class="form-control" value="<?php echo $rows[0]['name'] ?>" placeholder="Enter new name..." required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">BarCode</label>
                                    <input name="barCode" type="text" class="form-control" value="<?php echo $rows[0]['barCode'] ?>" placeholder="Item Barcode...">
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="form-group col-md-6">
                                    <label for="inputEmail4" class="col-form-label">Product Category</label>
                                    <select name="category" class="form-control form-select">
                                        <?php
                                        if($rows[0]['category'] == 0 ){
                                            ?>
                                            <option value="0"> -- Select Category --</option>
                                            <?php
                                        }else{
                                            ?>
                                            <option value="<?= $categRows[0]['id'] ?> "> <?= $categRows[0]['name'] ?> (current)</option>
                                            <?php
                                        }
                                        $this->viewCategoryOptionLoop();
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4" class="col-form-label">Selling Price ($USD)</label>
                                    <input name="sellingPrice" type="number" step="0.01" min="0.01" value="<?php echo $rows[0]['sellingPrice'] ?>" class="form-control" placeholder="Selling price" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4" class="col-form-label">Buying Price ($USD)</label>
                                    <input name="buyingPrice" type="number" step="0.01" min="0.01" value="<?php echo $rows[0]['buyingPrice'] ?>" class="form-control" placeholder="Buying price" required>
                                </div>
                            </div>

                            <div class="form-row row">
                                <div class="form-group col-md-4">
                                    <label for="inputEmail4" class="col-form-label">Current Quantity</label>
                                    <input name="quantity" type="number" value="<?php echo $rows[0]['quantity'] ?>" class="form-control" placeholder="quantity left" min="0" required>
                                </div>
                            </div>

                            <!--<span class="fa" style="font-size: 12px">Updating will reset this stock's item history, profits and statistics</span><br>-->
                            <button onclick="return confirm('Updating will affect, profits and statistics, continue?)" name="btn_update_Stock" class="btn btn-primary">Update <span class="fa fa-save"></span></button>
                        </div>
                    </form>

                    <hr>
                    <div class="form-group col-md-12">
                        <label>Special Action</label>
                        <a href="#!" data-toggle="modal" data-target="#dbInventoryModal">Update DB/Total Inventory Quantity for <?= $rows[0]['name'] ?></a>
                    </div>

                    <div class="modal fade" id="dbInventoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update DB Inventory Quantity?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body alert alert-warning rounded shadow-sm">NOTE:<br>This is regarded as opening stock after each stock take or Total Product(<?= $rows[0]['name'] ?>) Quantities or Stock Before Sales. Make sure you have received some notes from the system developer/s on how it works before updating </div>

                                <form method="POST" action="../includes/update.inc.php">
                                    <div class="card-body">
                                        <div class="form-group col-md-12">
                                            <label><b>DB Stock Quantity</b></label>
                                            <input name="itemID" value="<?php echo $id ?>" hidden>
                                            <input class="form-control" type="number" name="stockDbQuantity" value="<?= $rows[0]['newDQuantity'] ?>" >
                                        </div>
                                        <button onclick="return confirm('Are you sure you want to continue?')" name="btn_update_stockDbQuantity" class="btn btn-primary">Save <span class="fa fa-save"></span></button>
                                    </div>
                                </form>

                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php
        }
        else {
            $this->opps();
        }

    }

    public function CountView($query){
        $rows = $this->GetCountView($query);
        echo count($rows);
    }

    public function viewAllCategories(){
        $rows = $this->GetAllCategories();
        $s = 0;
        foreach ($rows as $row){
            $s+=1;
            ?>
            <tr>
                <td><?= $s ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $this->dateTimeToDay($row['dateAdded']) ?></td>
                <td>
                    <a href="../includes/delete.inc.php?delCategory&categID=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to remove this Category?')" class="fa fa-trash badge badge-danger"> Delete</a>
                </td>
            </tr>
            <?php
        }
    }

    public function viewAllStock(){
        $rows = $this->GetAllStock();
        $s = 0;

        foreach ($rows as $row)
        {
            $categRows = $this->GetCategoryByID($row['category']);
            if($categRows != NULL){
                $categRowsName = $categRows[0]['name'];
            }
            else{
                $categRowsName = 'empty';
            }
            $s++;
            ?>
            <tr>
                <td><?php echo $s ?> </td>
                <?php
                if($row['quantity'] > 0){
                    $bd = 'success';
                }
                else{
                    $bd = 'danger';
                }
                if($_SESSION['role'] == 'admin'){
                    ?>
                    <td><a class="text-<?= $bd ?>" href="stockDetails.php?itemID=<?php echo $row['id'] ?>"><?php echo $row["name"] ?></a></td>
                    <?php
                }
                else{

                    if ($row['quantity'] < 1) {
                        ?>
                        <td><span style="font-size: 13px" class="text-danger"><?php echo $row["name"] ?></span></td>
                        <?php
                    }else{
                        ?>
                        <td><a style="font-size: 13px" href="?addCart&itemID=<?php echo $row['id'] ?>"><?php echo $row["name"] ?></a></td>
                        <?php
                    }
                }
                ?>
                <td><span style="font-size: 10px"><?= $categRowsName ?></span></td>
                <td><?php echo $row['barCode'] ?></td>
                <td>$<?php echo $row['sellingPrice'] ?></td>
                <?php
                if($_SESSION['role'] == 'admin'){
                    ?>
                    <td>$<?php echo $row['buyingPrice'] ?></td>
                    <?php
                }
                ?>
                <td><span class="text-<?= $bd ?>"><?php echo $row['quantity'] ?>
                        <?php
                        if($_SESSION['role'] == 'admin'){
                            ?>
                            / <?php echo $row['newDQuantity'] ?>
                            <?php
                        }
                        ?>
                    </span>
                </td>
                <?php
                if($_SESSION['role'] == 'admin') {
                    ?>
                    <td>
                        <a href="stockDetails.php?itemID=<?php echo $row['id'] ?>"><span class="fa fa-pencil badge badge-primary"> More <span class="fa fa-chevron-circle-right"></span> </span></a>
                        <a href="../includes/delete.inc.php?delStock&delItem=<?php echo $row['id'] ?>" onclick="return confirm('Are you sure you want to remove this Stock?')" class="fa fa-trash badge badge-danger"> Delete</a>
                    </td>
                    <?php
                }
                else{
                    ?>

                    <?php
                    if($row['quantity'] < 1){
                        ?>
                        <td>
                            <span><span class="fa fa-pencil badge badge-danger">  <span class="fa fa-cart-plus"></span> </span></span>
                        </td>
                        <?php
                    }
                    else{
                        ?>
                        <td>
                            <a href="?addCart&itemID=<?php echo $row['id'] ?>"><span class="fa fa-pencil badge badge-primary">  <span class="fa fa-cart-plus"></span> </span></a>
                        </td>
                        <?php
                    }
                    ?>


                    <?php
                }
                ?>
            </tr>




            <?php
        }

    }


    public function viewALlStcokManualAdd(){
        $rows = $this->GetAllStock();
        $s = 0;

        foreach ($rows as $row)
        {
            $categRows = $this->GetCategoryByID($row['category']);
            if($categRows != NULL){
                $categRowsName = $categRows[0]['name'];
            }
            else{
                $categRowsName = 'empty';
            }
            $s++;
            ?>
            <tr>
                <td><?= $s ?></td>
                <td><a style="font-size: 13px" href="?addManually&itemID=<?php echo $row['id'] ?>"><?php echo $row["name"] ?></a></td>
                <td><span style="font-size: 10px"><?= $categRowsName ?></span></td>
                <td>$<?php echo $row['sellingPrice'] ?></td>
                <?php
                if($_SESSION['role'] == 'admin'){
                    ?>
                    <td>$<?php echo $row['buyingPrice'] ?></td>
                    <?php
                }
                ?>
                <td><?php echo $row['quantity'] ?> items</td>
                <td><a href="?addManually&itemID=<?php echo $row['id'] ?>"><span class="fa fa-pencil badge badge-primary">  <span class="fa fa-cart-plus"></span> </span></a></td>

            </tr>




            <?php
        }

    }



}
