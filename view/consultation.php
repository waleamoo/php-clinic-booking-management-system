<?php include("header.php"); ?>
<div class="container">

    <div class="row" style="margin-bottom: 300px;">
        <div class="col-md-6">
        <h2>Book an appointment</h2>
        <small style="color: #ccc;">Our experts are waiting to receive to every patients that needs medical 
            attention. All patients are equally important.</small>
        <hr>
            <?php if(isset($msg)){ echo $msg; }else{ echo ""; } ?>
            <form role="form" method="POST" action="index.php?action=book_consultation">
                
                <div class="form-group">
                    <label for="service">ID Number/Passport Number</label>
                    <input type="text" class="form-control" name="id" placeholder="ID/Passport Number" required>
                </div>
                
                <div class="form-group">
                    <label for="service">Health Service to Book</label>
                    <select name="service" class="form-control">
                        <?php foreach($categories as $cat): ?>
                        <option value="<?php echo $cat["c_id"]; ?>"><?php echo $cat["c_name"]; ?> @ R<?php echo $cat["c_price"]; ?>.00</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="time">Time</label>
                    <select name="time" id="service" class="form-control">
                        <option value="09:00">09:00 AM</option>
                        <option value="11:00">11:00AM</option>
                        <option value="13:00">1:00PM</option>
                        <option value="15:00">3:00PM</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Book Appointment</button>
                
            </form>
        </div>
        
        <div class="col-md-6">
            <h3 style="color: red;">Only 5 patients per hours</h3>
            <small style="color: #ccc;">Available time slots.</small>
            <table class="table-responsive-md table-bordered table">
                <tr><th>Time</th><th>Booked Appointments</th></tr>
                <tr><td>09:00 AM</td><td><?php $date = new DateTime('tomorrow'); $date = $date->format('Y-m-d'); echo get_booking_slot_count($date, '09:00 AM') ?></td></tr>
                <tr><td>11:00 AM</td><td><?php $date = new DateTime('tomorrow'); $date = $date->format('Y-m-d'); echo get_booking_slot_count($date, '11:00 AM') ?></td></tr>
                <tr><td>13:00 PM</td><td><?php $date = new DateTime('tomorrow'); $date = $date->format('Y-m-d'); echo get_booking_slot_count($date, '13:00 PM') ?></td></tr>
                <tr><td>15:00 PM</td><td><?php $date = new DateTime('tomorrow'); $date = $date->format('Y-m-d'); echo get_booking_slot_count($date, '15:00 PM') ?></td></tr>
            </table>
        </div>
    </div>

</div>
<?php include("footer.php"); ?>