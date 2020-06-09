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
                    <?php if (isset($message)) {echo $message;} else {echo "";} ?>
                    <form action="index.php?action=supplement_add" method="post" enctype="multipart/form-data">

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Supplement Category:</label>
                                <select name="category" class="form-control">
                                    <?php $cats = get_supplement_categories(); ?>
                                    <?php foreach ($cats as $cat): ?>
                                    <option value="<?php echo $cat["supplement_cat_id"] ?>"><?php echo $cat["supplement_cat_name"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Supplement Name:</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Supplement Description:</label>
                                <textarea required cols="10" rows="5" class="form-control" name="desc" placeholder="Describe product"></textarea>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Supplement Price:</label>
                                <input type="text" class="form-control" name="price" required>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Supplement Image:</label>
                                <input type="file" class="form-control-file" name="image" required>
                            </div>
                        </div>

                        <div class="control-group form-group">
                            <div class="controls">
                                <label>Quantity:</label>
                                <input type="number" class="form-control" name="qty" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg">Add Supplement </button>

                    </form>
                </div>
                <div class="card-footer small text-muted">Supplement appear in the table below.</div>
            </div>


            <!-- Area Chart Example-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    Supplement Listing</div>
                <div class="card-body">
                    <!-- Supplement Listing  -->

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <tr>
                                <th>Image</th>
                                <th>Supplement</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity in Stock</th>
                                <th colspan="2">&nbsp;</th>
                            </tr>
                            <?php if ($sups->rowCount() > 0) { ?>
                                <?php foreach ($sups as $sup) { ?>
                                    <tr>
                                        <td><img src="../assets/images/<?php echo $sup["supplement_img"]; ?>" width="50" height="50"></td>
                                        <td><?php echo $sup["supplement_name"]; ?></td>
                                        <td><textarea class="form-control" cols="10" rows="5" name="desc"><?php echo $sup["supplement_descr"]; ?></textarea></td>
                                        <td>R<?php echo $sup["supplement_price"]; ?>.00</td>
                                        <td><?php echo $sup["qty"]; ?></td>
                                        <td colspan="2">
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr><td colspan="2"><center>No supplement in stock</center></td></tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- /#wrapper -->
