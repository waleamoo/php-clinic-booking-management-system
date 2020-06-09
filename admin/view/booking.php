<?php include 'header.php'; ?>
    <div id="wrapper">
        
        <?php include 'sidebar.php'; ?>
      
      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="#">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">All Bookings</li>
          </ol>

          <!-- All Booking -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              All User Bookings</div>
            <div class="card-body">
                <p><?php if(isset($message)){ echo $message; }else{echo "";} ?></p>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Consultation</th>
                      <th>User</th>
                      <th>Doctor</th>
                      <th>Appointment Date</th>
                      <th>Appointment Time</th>
                      <th>Status</th>
                      <th>Price</th>
                      <th>Update</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                     <?php if($bookings->rowCount() > 0){ ?>
                      <?php foreach ($bookings as $p): ?>
                        <tr>
                            <td><?php echo get_consultation($p["c_id"]); ?></td>
                            <td><?php echo get_name($p["user_id"]); ?></td>
                            <td><?php echo $p["booking_date"]; ?></td>
                            <td><?php echo $p["booking_time"]; ?></td>
                            <td><?php echo $p["booking_status"]; ?></td>
                            <td>R<?php echo $p["booking_price"]; ?></td>
                            <?php if($p["booking_status"] == "Pending"){ ?>
                                <td><a href="?action=complete&id=<?php echo $p["booking_id"]; ?>" class="btn btn-success btn-sm">Mark as Complete</a></td>
                            <?php }else{ ?>
                                <td></td>
                            <?php } ?>
                             <td><a href="?action=delete&id=<?php echo $p["booking_id"]; ?>" class="btn btn-danger btn-sm">Cancel</a></td>
                        </tr>
                    
                    <?php endforeach; ?>
                    
                     <?php } else { ?>
                        <tr><th colspan="8">No Bookings</th></tr>
                     <?php } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Update now</div>
          </div>
          
          
        </div>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->
