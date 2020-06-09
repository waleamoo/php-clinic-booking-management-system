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
                <li class="breadcrumb-item active">Admin</li>
            </ol>

            <!-- Pending Booking -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Edit Admin</div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-sm-6">
                    <form action="?" method="post">
                        <h2>Update your administrative details</h2>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>HCP Name(s):</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $user["hcp_name"]; ?>">
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>HCP Email:</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $user["hcp_email"]; ?>">

                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>HCP Password:</label>
                                <input type="password" class="form-control" name="password" value="">
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Confirm Password:</label>
                                <input type="password" class="form-control" name="confirm_password">
                            </div>
                        </div>

                        <button type="submit" formaction="?" class="btn btn-primary">Update Admin Profile</button>

                    </form>
                    </div>
                    <div class="col-sm-6">
                    <form action="?" method="post">
                        <h2>Register an administrative user</h2>
                        <div class="control-group form-group">
                            <div class="controls">
                                <label>HCP Name(s):</label>
                                <input type="text" class="form-control" name="name" value="">
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>HCP Email:</label>
                                <input type="text" class="form-control" name="email" value="">

                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>HCP Password:</label>
                                <input type="password" class="form-control" name="password" value="">
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Confirm Password:</label>
                                <input type="password" class="form-control" name="con_password">
                            </div>
                        </div>

                        <button type="submit" formaction="?" class="btn btn-primary">Register Admin</button>

                    </form>
                    </div>
                </div>
                </div>
                <div class="card-footer small text-muted">Update Admin</div>
            </div>
        </div>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->
