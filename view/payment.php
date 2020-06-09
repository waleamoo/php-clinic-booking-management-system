<?php include("header.php"); ?>
<div class="container">

    <div class="row" style="margin-bottom: 300px;">
        <div class="col-md-6">
            <h2>Order total: R<?php echo $_SESSION["shipping_plus_total"]; ?>.00</h2>
            <hr>
            <?php if(isset($msg)){ echo $msg; }else{ echo ""; } ?>
            <form action="index.php?action=post_payment" method="post">
                <div class="form-group">
                    <label for="invoice_name">Card Name:</label>
                    <input type="text" name="invoice_name" value="" class="form-control" id="invoice_name">
                </div>
                <div class="form-group">
                    <label for="invoice_name">Card Number:</label>
                    <input type="text" name="invoice_name" value="" class="form-control" id="invoice_name">
                </div>
                <div class="form-group">
                    <label for="invoice_name">Expiry Date:</label>
                    <input type="text" name="invoice_name" value="" class="form-control" id="invoice_name">
                </div>
                <div class="form-group">
                    <label for="invoice_name">CVV:</label>
                    <input type="text" name="invoice_name" value="" class="form-control" id="invoice_name">
                </div>
                <div class="form-group">
                    <label for="invoice_name">PIN:</label>
                    <input type="password" name="invoice_name" value="" class="form-control" id="invoice_name">
                </div>
                <button class="btn btn-success btn-lg">Pay Now</button>
                
            </form>
        </div>
        
        <div class="col-md-6">
            <h3>Order Summary</h3>
            <table class="table-responsive-md table-bordered table">
                <tr><th>Subtotal:</th><td>R<?php echo $_SESSION["total"]; ?>.00</td></tr>
                <tr><th>Shipping Fee:</th><td>R<?php echo $_SESSION["total"]; ?>.00</td></tr>
                <tr><th>Total:</th><th>R<?php echo $_SESSION["shipping_plus_total"]; ?>.00</th></tr>
            </table>
        </div>


    </div>

</div>