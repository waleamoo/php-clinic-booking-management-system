
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="?action=logout">Logout</a>
          </div>
        </div>
      </div>
    </div>
    
    
    
    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="../admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../admin/js/sb-admin.min.js"></script>
    
    <script>
        var myChart = document.getElementById('myChart').getContext('2d');
        var massPopChart = new Chart(myChart, {
           type: "bar", // bar, horizontalBar, pie, line, doughnut, radar, polarArea
           data: {
               labels:<?php echo json_encode($monthNameArray); ?>,
               datasets: [{
                       label: 'Sales',
                       data: <?php echo json_encode($monthTotalArray); ?>
               }]
           },
           options: {}
        });
        
        
        var myPie = document.getElementById('myPie').getContext('2d');
        var massPopChart = new Chart(myPie, {
           type: "pie", // bar, horizontalBar, pie, line, doughnut, radar, polarArea
           data: {
               labels:<?php echo json_encode($monthNameArray); ?>,
               datasets: [{
                       label: 'Sales',
                       data: <?php echo json_encode($monthTotalArray); ?>
               }]
           },
           options: {}
        });
    </script>
  </body>

</html>
