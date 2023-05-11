<?php include '../pageIncludes/emptyLayoutTop.inc.php'; ?>

<div class="alert  alert-secondary shadow-sm text-dark border-bottom-primary -myactive">
    <h5><span class="fa  fa-shopping-cart"></span> Checkout</h5>
</div>

<style>
    .card{
        margin: auto;
        width: 600px;
        padding: 3rem 3.5rem;
        box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .mt-50 {
        margin-top: 50px
    }

    .mb-50 {
        margin-bottom: 50px
    }


    @media(max-width:767px){
        .card{
            width: 90%;
            padding: 1.5rem;
        }
    }
    @media(height:1366px){
        .card{
            width: 90%;
            padding: 8vh;
        }
    }
    .card-title{
        font-weight: 700;
        font-size: 2.5em;
    }
    .nav{
        display: flex;
    }
    .nav ul{
        list-style-type: none;
        display: flex;
        padding-inline-start: unset;
        margin-bottom: 6vh;
    }
    .nav li{
        padding: 1rem;
    }
    .nav li a{
        color: black;
        text-decoration: none;
    }
    .myactive{
        border-bottom: 8px solid purple;
        font-weight: bold;
    }

    input{
        border: none;
        outline: none;
        font-size: 1rem;
        font-weight: 600;
        color: #000;
        width: 100%;
        min-width: unset;
        background-color: transparent;
        border-color: transparent;
        margin: 0;
    }
    form a{
        color:grey;
        text-decoration: none;
        font-size: 0.87rem;
        font-weight: bold;
    }
    form a:hover{
        color:grey;
        text-decoration: none;
    }
    form .row{
        margin: 0;
        overflow: hidden;
    }
    form .row-1{
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 0.5rem;
        outline: none;
        width: 100%;
        min-width: unset;
        border-radius: 5px;
        background-color: rgba(221, 228, 236, 0.301);
        border-color: rgba(221, 228, 236, 0.459);
        margin: 2vh 0;
        overflow: hidden;
    }
    form .row-2{
        border: none;
        outline: none;
        background-color: transparent;
        margin: 0;
        padding: 0 0.8rem;
    }
    form .row .row-2{
        border: none;
        outline: none;
        background-color: transparent;
        margin: 0;
        padding: 0 0.8rem;
    }
    form .row .col-2,.col-7,.col-3{
        display: flex;
        align-items: center;
        text-align: center;
        padding: 0 1vh;
    }
    form .row .col-2{
        padding-right: 0;
    }

    #card-header{
        font-weight: bold;
        font-size: 0.9rem;
    }
    #card-inner{
        font-size: 0.7rem;
        color: gray;
    }
    .three .col-7{
        padding-left: 0;
    }
    .three{
        overflow: hidden;
        justify-content: space-between;
    }
    .three .col-2{
        border: 1px solid rgba(0, 0, 0, 0.137);
        padding: 0.5rem;
        outline: none;
        width: 100%;
        min-width: unset;
        border-radius: 5px;
        background-color: rgba(221, 228, 236, 0.301);
        border-color: rgba(221, 228, 236, 0.459);
        margin: 2vh 0;
        width: fit-content;
        overflow: hidden;
    }
    .three .col-2 input{
        font-size: 0.7rem;
        margin-left: 1vh;
    }
    .btnn{
        width: 100%;
        background-color: rgb(65, 202, 127);
        border-color: rgb(65, 202, 127);
        color: white;
        justify-content: center;
        padding: 2vh 0;
        margin-top: 3vh;
    }
    .btnn:focus{
        box-shadow: none;
        outline: none;
        box-shadow: none;
        color: white;
        -webkit-box-shadow: none;
        -webkit-user-select: none;
        transition: none;
    }
    .btnn:hover{
        color: white;
    }
    input:focus::-webkit-input-placeholder {
        color:transparent;
    }
    input:focus:-moz-placeholder {
        color:transparent;
    }
    input:focus::-moz-placeholder {
        color:transparent;
    }
    input:focus:-ms-input-placeholder {
        color:transparent;
    }
</style>


<div class="-page-content">
    <div class="container">
        <div class="card mt-50 mb-50">
            <div class="card-title mx-auto">
                Payment Checkout
            </div>
            <span class="text-center">Choose Payment Option Below</span>
            <hr>
            <?php
                $ecocashactive = 'notactive';
                $cardactive = 'notactive';
                $cashactive = 'notactive';

                if(isset($_GET['ecocash'])){
                    $ecocashactive = 'myactive';
                }

                if(isset($_GET['card'])){
                    $cardactive = 'myactive';
                }

                if(isset($_GET['cash'])){
                    $cashactive = 'myactive';
                }

            ?>
            <div -class="nav">
                <div class="mx-auto row">
                    <div class="col-md-12">
                        <li style="width: 100%" class="card <?php echo $cashactive ?>"><a class="text-decoration-none text-dark" href="?cash"><span class="fa fa-money-bill"></span> CASH</a></li>
                    </div>
                </div>
                <br>
                <div class="mx-auto row">
                    <div class="col-md-6">
                        <li style="width: 100%" class="card card-body <?php echo $ecocashactive ?>"><a class="text-decoration-none text-dark" href="?ecocash"><span class="mdi mdi-paypal"></span> ECO-CASH</a></li>
                    </div>
                    <div class="col-md-6">
                        <li style="width: 100%" class="card <?php echo $cardactive ?>"><a class="text-decoration-none text-dark" href="?card"><span class="fa fa-credit-card"></span> CARD</a></li>
                    </div>
                </div>
            </div>

            <hr>

            <?php
            if(isset($_GET['cash'])){
            ?>
                <form method="POST" action="../includes/insert.inc.php">
                    <h5 class="text-center">Cash Payment</h5>
                    <br>
                    <span id="card-header">Enter Cash Details Below:</span>

                    <input name="paid" hidden value="<?php
                    $tap = new Userview();
                    echo $tap->GetCartArtPriceByID($_SESSION['transactionID']);
                    ?>">

                    <div class="row two">
                        <?php
                        $tap = new Userview();
                        ?>
                        <div class="col-12">
                            <div class="col-7">
                                <div class="row-1">
                                    <select name="currency" class="form-control form-select" required>
                                        <option value="">--Currency--</option>
                                        <option value="usd">USD</option>
                                        <option value="bond">Bond</option>
                                        <option value="zar">ZAR</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>

                    <?php
                    $tap->viewAllPricesTable();
                    ?>



                    <div class="row">

                        <div class="col-md-6 card-body shadow-sm">
                            <b>Total Items:</b>
                            <span><b><?php
                                $cartc = new UserView();
                                echo $cartc->viewCartItemCount($_SESSION['transactionID']);
                                ?></b>
                            </span>
                        </div>
                    </div>


                    <hr>
                    <button onclick="return confirm('Pay using Cash?')" type="submit" name="cashPay" class="btn btn-primary d-flex mx-auto"><b>Pay</b></button>
                    <br>
                    <a class="btn btn-danger" href="payNow.php"><span class="fa fa-times-circle"> </span></a>
                </form>
            <?php
            }


            if(isset($_GET['ecocash'])){

            ?>
                <form method="POST" action="../includes/insert.inc.php">
                    <h5 class="text-center">Ecocash Payment</h5>
                    <br>
                    <span id="card-header">Enter Ecocash Details Below:</span>
                    <div class="row three">
                        <div class="col-7">
                            <div class="row-1">
                                <div class="row row-2">
                                    <span id="card-inner">Phone Number </span>
                                </div>
                                <div class="row row-2">
                                    <input name="phone" type="text" maxlength="10" minlength="10" onkeypress="return onlyNumberKey(event)" placeholder="0782 *** ***">
                                    <input name="paid" hidden value="<?php
                                    $tap = new Userview();
                                    echo $tap->GetCartArtPriceByID($_SESSION['transactionID']);
                                    ?>">
                                </div>
                            </div>
                        </div>

                    </div>
                    <br>
                    <?php
                    $tap->viewAllPricesTable();
                    ?>
                    <div class="row">
                        <div class="col-md-6 card-body shadow-sm">
                            <b>Total Items:</b>
                            <span><b><?php
                                    $cartc = new UserView();
                                    echo $cartc->viewCartItemCount($_SESSION['transactionID']);
                                    ?></b>
                            </span>
                        </div>
                    </div>


                    <hr>
                    <button onclick="return confirm('Pay using Ecocash?')" type="submit" name="ecocashPay" class="btn btn-primary d-flex mx-auto"><b>Pay</b></button>
                    <br>
                    <a class="btn btn-danger" href="payNow.php"><span class="fa fa-times-circle"> </span></a>
                </form>
            <?php
            }

            if (isset($_GET['card'])){
                ?>

                <form method="POST" action="../includes/insert.inc.php">
                    <h5 class="text-center">Card Payment</h5>
                    <br>
                    <span id="card-header">Enter Card Details Below:</span>

                    <div class="row three">
                        <div class="col-12">
                            <div class="row-1">
                                <div class="row row-2">
                                    <span id="card-inner">Card number</span>
                                </div>
                                <div class="row row-2">
                                    <input name="cardNumber" id="cstCCNumber" type="text" class="ccn" onkeyup="cc_format('cstCCNumber','cstCCardType');"  maxlength="19" placeholder="xxxx xxxx xxxx xxxx">
                                    <input name="paid" hidden value="<?php
                                    $tap = new Userview();
                                    echo $tap->GetCartArtPriceByID($_SESSION['transactionID']);
                                    ?>">
                                </div>
                            </div>
                            <script>
                                // SAMPLE FIELD:
                                function cc_format(ccid,ctid) {
                                    // supports Amex, Master Card, Visa, and Discover
                                    // parameter 1 ccid= id of credit card number field
                                    // parameter 2 ctid= id of credit card type field

                                    var ccNumString=document.getElementById(ccid).value;
                                    ccNumString=ccNumString.replace(/[^0-9]/g, '');
                                    // mc, starts with - 51 to 55
                                    // v, starts with - 4
                                    // dsc, starts with 6011, 622126-622925, 644-649, 65
                                    // amex, starts with 34 or 37
                                    var typeCheck = ccNumString.substring(0, 2);
                                    var cType='';
                                    var block1='';
                                    var block2='';
                                    var block3='';
                                    var block4='';
                                    var formatted='';

                                    if  (typeCheck.length==2) {
                                        typeCheck=parseInt(typeCheck);
                                        if (typeCheck >= 40 && typeCheck <= 49) {
                                            //cType='Visa';
                                        }
                                        else if (typeCheck >= 51 && typeCheck <= 55) {
                                            //cType='Master Card';
                                        }
                                        else if ((typeCheck >= 60 && typeCheck <= 62) || (typeCheck == 64) || (typeCheck == 65)) {
                                            //cType='Discover';
                                        }
                                        else if (typeCheck==34 || typeCheck==37) {
                                            //cType='American Express';
                                        }
                                        else {
                                            //cType='Invalid';
                                        }
                                    }

                                    // all support card types have a 4 digit firt block
                                    block1 = ccNumString.substring(0, 4);
                                    if (block1.length==4) {
                                        block1=block1 + ' ';
                                    }
                                        // for 4X4 cards
                                        block2 = ccNumString.substring(4, 8);
                                        if (block2.length==4) {
                                            block2=block2 + ' ';
                                        }
                                        block3 = ccNumString.substring(8, 12);
                                        if (block3.length==4) {
                                            block3=block3 + ' ';
                                        }
                                        block4 = ccNumString.substring(12, 16);


                                    formatted=block1 + block2 + block3 + block4;
                                    document.getElementById(ccid).value=formatted;
                                    document.getElementById(ctid).value=cType;
                                }
                            </script>


                        </div>
                    </div>
                    <hr>
                    <?php
                    $tap->viewAllPricesTable();
                    ?>
                    <div class="row">
                        <div class="col-md-6 card-body shadow-sm">
                            <b>Total Items:</b>
                            <span><b><?php
                                    $cartc = new UserView();
                                    echo $cartc->viewCartItemCount($_SESSION['transactionID']);
                                    ?></b>
                            </span>
                        </div>
                    </div>

                    <hr>
                    <button onclick="return confirm('Pay using Card?')" type="submit" name="cardPay" class="btn btn-primary d-flex mx-auto"><b>Pay</b></button>
                    <br>
                    <a class="btn btn-danger" href="payNow.php"><span class="fa fa-times-circle"> </span></a>
                </form>

            <?php
            }
            ?>
        </div>




<hr>








        <div class="pp-section"></div>

    </div>
</div>

<script>
    function onlyNumberKey(evt) {

        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>

<?php include '../pageIncludes/emptyLayoutBottom.inc.php'; ?>








