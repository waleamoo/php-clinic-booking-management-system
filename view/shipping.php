<?php include("header.php"); ?>
<div class="container">

    <div class="row" style="margin-bottom: 200px;">
        <div class="col-md-8 offset-md-2">
            <?php if(isset($auth)){ echo $auth; }else{ echo ""; } ?>
            <div id="shipping_msg"></div>
            <h2>Select a delivery method</h2>
            <form action="index.php?action=payment" method="post">
                <p>
                    <input type="radio" name="delivery" value="200" total="<?php echo $_SESSION['total']; ?>" door="200" id="door"> <label for="door">Door Delivery</label><br>
                    Get the supplement at your door step the following day. Additional business days apply to cities outside Mpumalanga.<br>
                    <strong>Shipping Fee: R200</strong>
                </p>
                
                <p>
                    <input type="radio" name="delivery" value="0" total="<?php echo $_SESSION['total']; ?>" free="0" id="pickup"> <label for="pickup">Pickup Station</label><br>
                    Get the supplement at Botlokwa store near you.<br>
                    <strong>Shipping Fee: Free</strong>
                </p>
                
                <hr>
                
                <div class="mb-4">
                    <div class="row">
                        <div class="col-6">Subtotal:</div><div class="col-6">R<?php echo $_SESSION['total']; ?>.00</div>
                    </div>
                    <div class="row">
                        <div class="col-6">Shipping Fee:</div><div class="col-6" id="shipping-cost"><strong><?php if(isset($_SESSION['shipping'])){ echo "R" .  $_SESSION['shipping'] . ".00";} else { echo "";} ?></strong></div>
                    </div>
                    <div class="row">
                        <div class="col-6"><strong>Total:</strong></div><div class="col-6" id="shipping-plus-total"><strong><?php if(isset($_SESSION['shipping'])){ echo "R" .  $_SESSION['shipping_plus_total'] . ".00";} else { echo "";} ?></strong></div>
                    </div>
                </div>
                <?php if(isset($_SESSION['shipping_plus_total'])){ ?>
                    <a href="?action=payment" class="btn btn-success btn-lg" >Proceed to Payment</a>
                <?php } ?>
            </form>
            
            
        </div>
    </div>

</div>