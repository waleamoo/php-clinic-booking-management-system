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
            <li class="breadcrumb-item active">All Users</li>
          </ol>

          <!-- Pending Booking -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              All User Details on Record</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID Number</th>
                      <th>Name</th>
                      <th>Surname</th>
                      <th>Age</th>
                      <th>Gender</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                      
                     <?php if($user->rowCount() > 0){ ?>
                      <?php foreach ($user as $use): ?>
                    <tr>
                        <td><?php echo $use["patient_id"]; ?></td>
                      <td><?php echo $use["patient_name"]; ?></td>
                      <td><?php echo $use["patient_surname"]; ?></td>
                      <td><?php echo $use["patient_age"]; ?></td>
                      <td><?php echo $use["patient_gender"]; ?></td>
                      <td><?php echo $use["patient_phone"]; ?></td>
                      <td><?php echo $use["patient_address"]; ?></td>
                      <td><?php echo $use["patient_email"]; ?></td>
                    </tr>
                    
                    <?php endforeach; ?>
                    
                     <?php } else { ?>
                    <tr><th colspan="8">No User</th></tr>
                    
                     <?php } ?>
                    
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer small text-muted">Updated now</div>
          </div>
          
          
          
        </div>

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your ForLife MediHealth 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->
