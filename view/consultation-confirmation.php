<?php include("header.php"); ?>
<div class="container">

    <div class="row" style="margin-bottom: 300px;">
        <div class="col-md-8 offset-md-2">
            <h2>Booking Confirmation</h2>  
            <hr>
            
            <div class="card">
                <div class="card-header">
                    Booking Details
                </div>
                <div class="card-body">
                    <?php if(isset($msg)){ echo $msg; }else{ echo ""; } ?>
                    <?php if (isset($_SESSION["time"])){ ?>
                    <strong>Your booking details.</strong>
                    <div class='row'>
                        <div class='col'><b>ID Number</b></div>
                        <div class='col'><b>Booking</b></div>
                        <div class='col'><b>Time</b></div>
                        <div class='col'><b>Date</b></div>
                        <div class='col'><b>Price(R)</b></div>
                        <div class='col'><b>Delete</b></div>
                    </div>
                    
                    <div class='row'>
                        <div class='col'><?php echo $_SESSION["id"]; ?></div>
                        <div class='col'><?php echo $_SESSION["service_name"]; ?></div>
                        <div class='col'><?php echo $_SESSION["time"]; ?></div>
                        <div class='col'><?php echo $_SESSION["date"]; ?></div>
                        <div class='col'>R<?php echo $_SESSION["price"]; ?>.00</div>
                    <div class='col'><a href="?action=delete_booking" class="btn btn-danger btn-sm">Delete</a></div>
                    </div>

                    <div class="row">
                        <div class="col"><a href="?action=confirm_booking" class="btn btn-success btn-lg">Confirm Booking</a></div>
                    </div>
                    
                    <?php }else{ ?>
                        <h1 class="display-4">No booking yet.</h1>
                    <?php } ?>
                    <br>
                    
                </div>

                <!-- Previous bookings -->

            </div>

        </div>
    </div>

</div>
<?php include("footer.php"); ?>