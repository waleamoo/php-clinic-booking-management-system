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

                    <!-- Navbar Search -->
                    <form action="index.php?action=search" class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" method="post">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search user name..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Surname</th>
                                    <th>Phone(Home)</th>
                                    <th>Phone(Work)</th>
                                    <th>Phone(Cell)</th>
                                    <th>Email</th>
                                    <th>Reference</th>
                                    <th>DOB</th>
                                    <th>Address</th>
                                    <th>Gender</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if ($users->rowCount() > 0) { ?>
                                    <?php foreach ($users as $p): ?>
                                        <tr>
                                            <td><?php echo $p["user_id"]; ?></td>
                                            <td><?php echo $p["user_first_name"]; ?></td>
                                            <td><?php echo $p["user_surname"]; ?></td>
                                            <td><?php echo $p["user_tel_h"]; ?></td>
                                            <td><?php echo $p["user_tel_w"]; ?></td>
                                            <td><?php echo $p["user_tel_c"]; ?></td>
                                            <td><?php echo $p["user_email"]; ?></td>
                                            <td><?php echo $p["user_reference"]; ?></td>
                                            <td><?php echo $p["user_dob"]; ?></td>
                                            <td><?php echo $p["user_address"]; ?></td>
                                            <td><?php echo $p["user_gender"]; ?></td>
                                            <td><a href="?action=complete&id=<?php echo $p["user_id"]; ?>" class="btn btn-success btn-sm">Email</a></td>
                                        </tr>

                                    <?php endforeach; ?>

                                <?php } else { ?>
                                    <tr><th colspan="12">No User</th></tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer small text-muted">Update now</div>
            </div>


        </div>

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Alt Life 2019</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->
