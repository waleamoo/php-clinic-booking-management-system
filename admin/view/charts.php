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
            <li class="breadcrumb-item active">Charts</li>
          </ol>
          
          <!-- Area Chart Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Bar Chart (Indicating Monthly Sales)</div>
            <div class="card-body">
              <canvas id="myChart"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
          
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-chart-area"></i>
              Pie Chart (Indicating Monthly Sales)</div>
            <div class="card-body">
              <canvas id="myPie"></canvas>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>
          
        </div>
        <!-- /.container-fluid -->


      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include 'footer.php'; ?>