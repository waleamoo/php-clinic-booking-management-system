<?php include 'header.php'; ?>
<div id="wrapper">

    <?php include 'sidebar.php'; ?>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="?action=home">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Supplements</li>
            </ol>

            <!-- Area Chart Example-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    Supplement Add and Listings</div>
                <div class="card-body">  
                    <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>Supplement</th>
                            <th>Quantity in Stock</th>
                        </tr>
                        <tr><th colspan="2" class="bg-success"><center>MODERATE STOCK SUPPLEMENT (10 and Above)</center></th></tr>
                        <?php if($moderate->rowCount() > 0){ ?>
                        <?php foreach ($moderate as $value) { ?>
                        <tr>
                            <td><?php echo $value["supplement_name"]; ?></td>
                            <td><?php echo $value["qty"]; ?></td>
                        </tr>
                        <?php } ?>
                        <?php }else{ ?>
                            <tr><td colspan="2"><center>No moderate stock</center></td></tr>
                        <?php } ?>
                        <tr><th colspan="2" class="bg-warning"><center>LOW STOCK SUPPLEMENT (9 and Below)</center></th></tr>
                        <?php if($low->rowCount() > 0){ ?>
                        <?php foreach ($low as $value) { ?>
                        <tr>
                            <td><?php echo $value["supplement_name"]; ?></td>
                            <td><?php echo $value["qty"]; ?></td>
                        </tr>
                        <?php } ?>
                        <?php }else{ ?>
                            <tr><td colspan="2"><center>No supplement low in stock</center></td></tr>
                        <?php } ?>
                        <tr><th colspan="2" class="bg-danger"><center>OUT OF STOCK SUPPLEMENT (0)</center></th></tr>
                        <?php if($out->rowCount() > 0){ ?>
                        <?php foreach ($out as $value) { ?>
                        <tr>
                            <td><?php echo $value["supplement_name"]; ?></td>
                            <td><?php echo $value["qty"]; ?></td>
                        </tr>
                        <?php } ?>
                        <?php }else{ ?>
                            <tr><td colspan="2"><center>No supplement out of stock</center></td></tr>
                        <?php } ?>
                </table>
            </div>
                    
                </div>
                <div class="card-footer small text-muted">Updated just now</div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->
