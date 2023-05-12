
<?php


class Model extends Dbh{

    protected function GetAmountByPaymentType($payementType, $day){
        $sql = "SELECT * FROM payment WHERE dateAdded LIKE ? and paymentType LIKE ?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$day, $payementType]);
        return $stmt->fetchAll();
    }


    protected function updateStockToPhysicalQuantities($uid){
        $rows = $this->GetStockTakeChildByUID($uid);
        foreach ($rows as $row){
            $stockID = $row['stockID'];
            $newQ = $row['stockPhysicalQuantity'];
            $sql = "UPDATE stock SET newDQuantity=?, quantity=? WHERE id=?";
            $stmt = $this->con()->prepare($sql);
            if(!$stmt->execute([$newQ, $newQ, $stockID])){
                $this->opps();
            }
        }
    }


    protected function duplicateRemover($rows, $column){
        $row_array = array();
        $main_array = array();
        foreach ($rows as $row){
            if(!in_array($row[$column], $row_array)){
                $row_array [] = $row[$column];
                $main_array [] = $row;
            }
        }
        return $main_array;
    }


    protected function updatestockMainStatus($uid){
        $status = 1;
        $sql = "UPDATE stockTakeMain SET status=? WHERE uid=?";
        $stmt = $this->con()->prepare($sql);
        if(!$stmt->execute([$status, $uid])){
            $this->opps();
        }
    }

    protected function udateProductStockTake($pid, $uid, $physicalQuantities){
        $status = 1;
        $sql = "UPDATE stockTakeChild SET stockPhysicalQuantity=?, status=? WHERE id=? AND uid=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$physicalQuantities, $status, $pid, $uid])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Product Recorded';
            echo "<script type='text/javascript'>;
                  window.location='../admin/stocktake.php?uid=$uid';
                </script>";
        }else{
            $this->opps();
        }
    }

    protected function newStockTake($userID){
        $status = 0;
        $today = date('Y-m-d H:i:s');
        $randomStr = $this->generateRandomString(12);
        $sql = "INSERT INTO stockTakeMain(uid, status, dateAdded, addedBY, lastUpdatedBy) VALUES (?,?,?,?,?)";
        $stmt = $this->con()->prepare($sql);
        if(!$stmt->execute([$randomStr, $status,$today, $userID, $userID])){
            $this->opps();
        }

        //Copy Current Stock products details to a new table
        $rows = $this->GetAllStock();
        $zero = '0';
        foreach ($rows as $row){
            $name = $row['name'];
            $DBNetQ = $row['newDQuantity'];
            $stockID = $row['id'];
            $DBGrossQ = $row['quantity'];
            $buyingPrice = $row['buyingPrice'];
            $sellingPrice = $row['sellingPrice'];

            $sql1 = "INSERT INTO stockTakeChild(uid, stockID, stockName, stockDBNetQuantity, stockDBGrossQuantity, stockPhysicalQuantity, stockBuyingPrice, stockSellingPrice, status) VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt1 = $this->con()->prepare($sql1);
            if(!$stmt1->execute([$randomStr, $stockID, $name, $DBNetQ, $DBGrossQ, $zero, $buyingPrice, $sellingPrice, $zero])){
                $this->opps();
            }
        }

        //below code has been updated to use function $this->updateStockToPhysicalQuantities();
        //reset stock to match existing stock thus everything back to zero and start new transactions
        //$this->newDay();


        $_SESSION['type'] = 's';
        $_SESSION['err'] = 'Stock take Session is ready';
        echo "<script type='text/javascript'>;
                  window.location='../admin/stocktake.php?uid=$randomStr';
                </script>";

    }

    protected function updateRates($rate, $currency){
        $sql = "UPDATE rates SET rate=? WHERE currency=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$rate, $currency])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = $currency . ' rate update successfully';
            echo "<script type='text/javascript'>;
                  history.back(-1);
                </script>";
        }else{
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Something went wrong. Please try again';
            echo "<script type='text/javascript'>;
                  history.back(-1);
                </script>";
        }
    }

    protected function GetRatesByCurrency($currency){
        $sql = "SELECT * FROM rates WHERE currency=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$currency]);
        return $stmt->fetchAll();
    }

    protected function manualAddSale($currency, $quantity, $itemID, $role){
        $stockRows = $this->GetStockByID($itemID);

        $newPriceD = $stockRows[0]['sellingPrice'] * $quantity;
        $newQuantity = $stockRows[0]['quantity'] - $quantity;

        $currencyPayed = $currency;

        if($currency == 'usd'){
            $newPrice = $newPriceD;
        }else{
            if($currency == 'ecocash rtgs' || $currency == 'card rtgs'){
                $currency = 'rtgs';
            }
            $sqlr = "SELECT * FROM rates WHERE currency=?";
            $stmtr = $this->con()->prepare($sqlr);
            $stmtr->execute([$currency]);
            $rateRows = $stmtr->fetchAll();
            $newPrice = ($rateRows[0]['rate'] * $stockRows[0]['sellingPrice']) * $quantity ;
        }

        $sql = "UPDATE stock SET quantity=? WHERE id=?";
        $stmt = $this->con()->prepare($sql);

        $sql2 = "INSERT INTO payment(transactionID, itemID, quantity, price, paymentType, dateAdded, cardNumber, phoneNumber) values (?,?,?,?,?,?,?,?)";
        $stmt2 = $this->con()->prepare($sql2);

        $manuallyAdded = 'Manually Added';
        $manual = 'Manual (' .$currencyPayed. ')';
        $blank = '';
        $today = date('Y-m-d H:i:s');

        if($stmt->execute([$newQuantity, $itemID]) AND $stmt2->execute([$manuallyAdded, $itemID, $quantity, $newPrice, $manual, $today, $blank, $blank])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Manual Sell Added Successfully';
            echo "<script type='text/javascript'>;
                  window.location='../$role/manualAdd.php';
                </script>";
        }
        else{
            $this->opps();
        }
    }

    protected function GetCategoryByID($categID){
        $sql = "SELECT * FROM categories WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$categID]);
        return $stmt->fetchAll();
    }

    protected function delCategory($categID){
        $rows =$this->GetStockByCategID($categID);
        if(count($rows) > 0){
            foreach ($rows as $row){
                $newCateg = 0;
                $sql1 = "UPDATE stock SET category=? WHERE id=?";
                $stmt1 = $this->con()->prepare($sql1);
                $stmt1->execute([$newCateg, $row['id']]);
            }
        }

        $sql2 = "DELETE FROM categories WHERE id=?";
        $stmt2 = $this->con()->prepare($sql2);
        if($stmt2->execute([$categID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Category Deleted';
            echo "<script type='text/javascript'>;
                  history.back(-1);
                </script>";
        }else{
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'SOmething went wrong: Category Failed To Delete';
            echo "<script type='text/javascript'>;
                  history.back(-1);
                </script>";
        }

    }

    protected function GetStockTakeChildByIDANDUID($pID, $uid){
        $sql = "SELECT * FROM stockTakeChild WHERE id=? AND uid=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$pID, $uid]);
        return $stmt->fetchAll();
    }


    protected function GetStockTakeMainByUID($uid){
        $sql = "SELECT * FROM stockTakeMain WHERE uid=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$uid]);
        return $stmt->fetchAll();
    }


    protected function GetStockTakeChildByUID($uid){
        $sql = "SELECT * FROM stockTakeChild WHERE uid=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$uid]);
        return $stmt->fetchAll();
    }

    protected function GetStockByCategID($categID){
        $sql = "SELECT * FROM stock WHERE category=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$categID]);
        return $stmt->fetchAll();
    }

    protected function GetAllCategories(){
        $sql = "SELECT * FROM categories";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function addCategory($name){
        $rows = $this->GetCategoriesByName($name);
        if(count($rows) > 0){
            $_SESSION['type'] = 'w';
            $_SESSION['err'] = 'Category Already Exist';
            echo "<script type='text/javascript'>;
                  history.back(-1);
                </script>";
        }
        else{
            $today = date('Y-m-d H:i:s');
            $sql = "INSERT INTO categories(name, dateAdded) VALUES (?,?)";
            $stmt = $this->con()->prepare($sql);
            if($stmt->execute([$name, $today])){
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Category Added Successfully';
                echo "<script type='text/javascript'>;
                  history.back(-1);
                </script>";
            }else{
                $_SESSION['type'] = 'w';
                $_SESSION['err'] = 'Something went wrong.Please try again';
                echo "<script type='text/javascript'>;
                  history.back(-1);
                </script>";
            }
        }
    }

    protected function GetCategoriesByName($name){
        $sql = "SELECT * FROM categories WHERE name=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$name]);
        return $stmt->fetchAll();
    }



    protected function cashPay($currency, $paid, $total, $transID, $role){
        $today = date('Y-m-d H:i:s');
        $cartRows = $this->GetCartByTransactionID($transID);
        if(count($cartRows) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'You should have at-least one item in your cart that you want to purchase';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }else {

            $payMethod = "cash (". $currency .")";
            $blank = '';

            $change = $paid - $total;

            foreach ($cartRows as $cartRow){
                $itemID = $cartRow['itemID'];
                $quantity = $cartRow['quantity'];
                $priceN = $cartRow['price'];

                if($currency == 'usd'){
                    $price = $priceN;
                }else{
                    $sqlr = "SELECT * FROM rates WHERE currency=?";
                    $stmtr = $this->con()->prepare($sqlr);
                    $stmtr->execute([$currency]);
                    $rateRows = $stmtr->fetchAll();
                    $price = $priceN * $rateRows[0]['rate'];
                }

                $sql = "INSERT INTO payment(transactionID, itemID, quantity, price, paymentType, dateAdded, cardNumber, phoneNumber) 
                        VALUES (?,?,?,?,?,?,?,?)";
                $stmt = $this->con()->prepare($sql);
                if($stmt->execute([$transID, $itemID, $quantity, $price, $payMethod, $today, $blank, $blank])){

                    $sqld = "DELETE FROM cart WHERE itemID=?";
                    $stmtd = $this->con()->prepare($sqld);
                    $stmtd->execute([$itemID]);

                    $_SESSION['type'] = 'i';
                    $_SESSION['err'] = 'Cash Transaction Complete: Change is: <span class="text-dark">$'.$change.'</span>';
                    echo "<script type='text/javascript'>;
                      window.location='../$role/dashboard.php';
                    </script>";
                }
                else{
                    $this->opps();
                }
            }

        }
    }

    protected function ecocashPay($phone, $paid, $total, $transID, $role){
        $today = date('Y-m-d H:i:s');
        $cartRows = $this->GetCartByTransactionID($transID);
        if(count($cartRows) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'You should have at-least one item in your cart that you want to purchase';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }else {

            $payMethod = "ecocash (rtgs)";
            $blank = '';
            $change = $paid - $total;

            foreach ($cartRows as $cartRow){
                $itemID = $cartRow['itemID'];
                $quantity = $cartRow['quantity'];
                $priceN = $cartRow['price'];

                $rtgs = 'rtgs';
                $sqlr = "SELECT * FROM rates WHERE currency=?";
                $stmtr = $this->con()->prepare($sqlr);
                $stmtr->execute([$rtgs]);
                $rateRows = $stmtr->fetchAll();
                $price = $priceN * $rateRows[0]['rate'];

                $sql = "INSERT INTO payment(transactionID, itemID, quantity, price, paymentType, dateAdded, cardNumber, phoneNumber) 
                        VALUES (?,?,?,?,?,?,?,?)";
                $stmt = $this->con()->prepare($sql);
                if($stmt->execute([$transID, $itemID, $quantity, $price, $payMethod, $today, $blank, $phone])){

                    $sqld = "DELETE FROM cart WHERE itemID=?";
                    $stmtd = $this->con()->prepare($sqld);
                    $stmtd->execute([$itemID]);

                    $_SESSION['type'] = 'i';
                    $_SESSION['err'] = 'Ecocash Transaction Complete: Change is: <span class="text-dark">$'.$change.'</span>';
                    echo "<script type='text/javascript'>;
                      window.location='../$role/dashboard.php';
                    </script>";
                }
                else{
                    $this->opps();
                }
            }

        }
    }

    protected function cardPay($cardNumber, $paid, $total, $transID, $role){
        $today = date('Y-m-d H:i:s');
        $cartRows = $this->GetCartByTransactionID($transID);
        if(count($cartRows) < 1){
            $_SESSION['type'] = 'd';
            $_SESSION['err'] = 'You should have at-least one item in your cart that you want to purchase';
            echo "<script type='text/javascript'>;
                      history.back(-1);
                    </script>";
        }else {

            $payMethod = "card (rtgs)";
            $blank = '';
            $change = $paid - $total;

            foreach ($cartRows as $cartRow){
                $itemID = $cartRow['itemID'];
                $quantity = $cartRow['quantity'];
                $priceN = $cartRow['price'];

                $rtgs = 'rtgs';
                $sqlr = "SELECT * FROM rates WHERE currency=?";
                $stmtr = $this->con()->prepare($sqlr);
                $stmtr->execute([$rtgs]);
                $rateRows = $stmtr->fetchAll();
                $price = $priceN * $rateRows[0]['rate'];

                $sql = "INSERT INTO payment(transactionID, itemID, quantity, price, paymentType, dateAdded, cardNumber, phoneNumber) 
                        VALUES (?,?,?,?,?,?,?,?)";
                $stmt = $this->con()->prepare($sql);
                if($stmt->execute([$transID, $itemID, $quantity, $price, $payMethod, $today, $cardNumber, $blank])){

                    $sqld = "DELETE FROM cart WHERE itemID=?";
                    $stmtd = $this->con()->prepare($sqld);
                    $stmtd->execute([$itemID]);

                    $_SESSION['type'] = 'i';
                    $_SESSION['err'] = 'Card Transaction Complete: Change is: <span class="text-dark">$'.$change.'</span>';
                    echo "<script type='text/javascript'>;
                      window.location='../$role/dashboard.php';
                    </script>";
                }
                else{
                    $this->opps();
                }
            }

        }
    }


    protected function GetCartByID($id){
        $sql = "SELECT * FROM cart WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function delCart($itemID, $role){
        $cartRows = $this->GetCartByID($itemID);
        $stockItemID = $cartRows[0]['itemID'];
        $stockRows = $this->GetStockByID($stockItemID);

        $newQuantity = $stockRows[0]['quantity'] + $cartRows[0]['quantity'];
        $sql = "UPDATE stock SET quantity=? WHERE id=?";
        $stmt = $this->con()->prepare($sql);

        $sql1 = "DELETE FROM cart WHERE id=?";
        $stmt1 = $this->con()->prepare($sql1);


        if($stmt->execute([$newQuantity, $stockItemID]) AND $stmt1->execute([$itemID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Item Removed from cart';
            echo "<script type='text/javascript'>;
                  window.location='../$role/transact.php';
                </script>";
        }
        else{
            $this->opps();
        }
    }

    protected function addcart($itemID, $transID, $price, $quantity,$role){
        $sql1 = "INSERT INTO cart(transactionID, itemID, price, quantity) VALUES(?,?,?,?)";
        $stmt1 = $this->con()->prepare($sql1);

        $stockRows = $this->GetStockByID($itemID);
        $newQuantity = $stockRows[0]['quantity'] - $quantity;
        $sql = "UPDATE stock SET quantity=? WHERE id=?";
        $stmt = $this->con()->prepare($sql);

        if($stmt1->execute([$transID, $itemID, $price, $quantity]) AND $stmt->execute([$newQuantity, $itemID]) ){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Added to cart';
            echo "<script type='text/javascript'>;
                  window.location='../$role/transact.php';
                </script>";
        }
        else{
            $this->opps();
        }

    }

    protected function GetCartByTransactionID($id){
        $sql = "SELECT * FROM cart WHERE transactionID=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    function generateRandomString($length){
        $include_chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        /* Uncomment below to include symbols */
        /* $include_chars .= "[{(!@#$%^/&*_+;?\:)}]"; */
        $charLength = strlen($include_chars);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $include_chars [rand(0, $charLength - 1)];
        }
        return $randomString;
    }

    protected function GetCart(){
        $sql = "SELECT * FROM cart";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function newTransaction($role){
        $rows = $this->GetCart();

        foreach ($rows as $row){
            $stockRows =$this->GetStockByID($row['itemID']);
            $newStockQuantity = $stockRows[0]['quantity'] + $row['quantity'];
            $sql = "UPDATE stock SET quantity=? WHERE id=?";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$newStockQuantity, $row['itemID']]);

            $sqlD = "DELETE FROM cart WHERE itemID=?";
            $stmtD = $this->con()->prepare($sqlD);
            $stmtD->execute([$row['itemID']]);
        }

        $result = $this->generateRandomString(12);
        $_SESSION['transactionID'] = $result;
        $newTrans = $_SESSION['transactionID'];
        $_SESSION['type'] = 'i';
        $_SESSION['err'] = 'New Transaction Ready: ' . $newTrans;
        echo "<script type='text/javascript'>;
                      window.location='../$role/transact.php';
                    </script>";


    }


    protected function newDay(){
        $rows = $this->GetAllStock();
        foreach ($rows as $row){
            $sql = "UPDATE stock SET newDQuantity=?, newDBuyingPrice=?, newDSellingPrice=? WHERE id=?";
            $stmt = $this->con()->prepare($sql);
            $stmt->execute([$row['quantity'], $row['buyingPrice'], $row['sellingPrice'], $row['id']]);
        }
    }

    protected function GetPaymentsByDate($today){
        $sql = "SELECT * FROM payment WHERE dateAdded LIKE ? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$today]);
        return $stmt->fetchAll();
    }

    protected function GetAllPayments(){
        $sql = "SELECT * FROM payment ORDER BY dateAdded DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function addStock($name, $barCode, $buyingPrice, $sellingPrice, $quantities, $category){
        $today = date('Y-m-d H:i:s');

        $sqlF = "SELECT * FROM stock WHERE name=?";
        $stmtF = $this->con()->prepare($sqlF);
        $stmtF->execute([$name]);
        $rows = $stmtF->fetchAll();

        if(count($rows) > 0){
            $oldQ = $rows[0]['quantity'];
            $newQ = $oldQ + $quantities;


            //NewDQuantity will be incremented as  new added inventory stock is also incremented
            $NewDQuantity = $rows[0]['newDQuantity'] + $quantities;




            $sql = "UPDATE stock SET quantity=?, buyingPrice=?, sellingPrice=?, dateAdded=?, newDQuantity=?, newDBuyingPrice=?, newDSellingPrice=?, category=? WHERE name=?";
            $stmt = $this->con()->prepare($sql);
            if ($stmt->execute([$newQ, $buyingPrice, $sellingPrice, $today, $NewDQuantity, $buyingPrice, $sellingPrice, $category, $name])) {
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Stock Supplies('.$name.') Added(' . $quantities . ')';
                echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
            } else {
                $this->opps();
            }
        }
        else {
            $sql = "INSERT INTO stock(name, barCode, quantity, buyingPrice, sellingPrice, dateAdded, newDQuantity, newDBuyingPrice, newDSellingPrice, category) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $stmt = $this->con()->prepare($sql);
            if ($stmt->execute([$name, $barCode, $quantities, $buyingPrice, $sellingPrice, $today, $quantities, $buyingPrice, $sellingPrice, $category])) {
                $_SESSION['type'] = 's';
                $_SESSION['err'] = 'Stock Supplies('.$name.') Added(' . $quantities . ')';
                echo "<script type='text/javascript'>
                        history.back(-1);
                      </script>";
            } else {
                $this->opps();
            }
        }

    }

    protected function delStock($itemID){
        $rows = $this->GetStockByID($itemID);
        $stockname = $rows[0]['name'];

        $sql = "DELETE FROM stock WHERE id=?";
        $stmt = $this->con()->prepare($sql);

        if($stmt->execute([$itemID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = $stockname .' deleted Successfully';
            echo "<script type='text/javascript'>
                        window.location='../admin/stock.php';
                      </script>";
        }
        else{
            $this->opps();
        }
    }

    protected function updateStockDbQuantity($role, $itemID, $stockDbQuantity){
        $sql = "UPDATE stock SET newDQuantity=? WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$stockDbQuantity, $itemID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'DB/Total Product Quantity Update Successful';
            echo "<script type='text/javascript'>;
                      window.location='../$role/stockDetails.php?itemID=$itemID';
                    </script>";
        }else{
            $this->opps();
        }
    }

    protected function updateStock($role, $name, $category, $barCode, $buyingPrice, $sellingPrice, $quantities, $itemID){
        $today = date('Y-m-d H:i:s');
        $stockRows = $this->GetStockByID($itemID);
        $oldQ = $stockRows[0]['newDQuantity'];

        $stockdiff = $quantities - $oldQ;
        if($stockdiff > 0) {
            $newStock = $oldQ + $stockdiff;
        }else{
            $newStock = $oldQ;
        }

        $sql = "UPDATE stock SET name=?, category=?, barCode=?, buyingPrice=?, sellingPrice=?, quantity=?, dateAdded=?, newDQuantity=?, newDBuyingPrice=?, newDSellingPrice=? WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        if($stmt->execute([$name, $category, $barCode, $buyingPrice, $sellingPrice, $quantities, $today, $newStock, $buyingPrice, $sellingPrice, $itemID])){
            $_SESSION['type'] = 's';
            $_SESSION['err'] = 'Update Successful';
            echo "<script type='text/javascript'>;
                      window.location='../$role/stockDetails.php?itemID=$itemID';
                    </script>";
        }
        else{
            $this->opps();
        }
    }

    protected function GetStockByID($id){
        $sql = "SELECT * FROM stock WHERE id=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    protected function GetCountView($query){
        $stmt = $this->con()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }



    protected function GetPendingMainStockTakeByStatusAndUID($status, $uid){
        $sql = "SELECT * FROM stockTakeChild WHERE status=? AND uid=?";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$status, $uid]);
        return $stmt->fetchAll();
    }

    protected function GetPendingMainStockTakeByStatus($status){
        $sql = "SELECT * FROM stockTakeMain WHERE status=? ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute([$status]);
        return $stmt->fetchAll();
    }

    protected function GetAllChildStockTake(){
        $sql = "SELECT * FROM stockTakeChild ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetAllMainStockTake(){
        $sql = "SELECT * FROM stockTakeMain ORDER BY id DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function GetAllStock(){
        $sql = "SELECT * FROM stock ORDER BY dateAdded DESC";
        $stmt = $this->con()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    protected function opps(){
        $_SESSION['type'] = 'w';
        $_SESSION['err'] = 'Something went wrong.Please try again';
        echo "<script type='text/javascript'>
                history.back(-1);
              </script>";
    }

    protected function dateToDay($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('l j F Y',$history_bus_date_tostring);
    }

    protected function dateToDayMDY($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('F j Y',$history_bus_date_tostring);
    }

    protected function dateTimeToDay($mydate){
        $history_bus_date_variable = $mydate;
        $history_bus_date_tostring = strtotime($history_bus_date_variable);
        return date('l j F Y H:m:s A',$history_bus_date_tostring);
    }

    protected function timeAgo($mydate){
        $time_ago = strtotime($mydate);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "just now";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "One Minute Ago";
            }
            else{
                return "$minutes Minutes Ago";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "an Hour Ago";
            }else{
                return "$hours Hrs Ago";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "Yesterday";
            }else{
                return "$days Days Ago";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "a Week Ago";
            }else{
                return "$weeks Weeks Ago";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "a Month Ago";
            }else{
                return "$months Months Ago";
            }
        }
        //Years
        else{
            if($years==1){
                return "One Year Ago";
            }else{
                return "$years Years Ago";
            }
        }
    }
}