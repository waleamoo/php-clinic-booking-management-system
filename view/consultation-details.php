<?php include("header.php"); ?>
<div class="container">
    
    <div class="row" style="margin-bottom: 300px;">
        <h2><?php echo $consultation["c_name"]; ?></h2>
        <hr>
        <div class="panel panel-default">
            <div class="panel-body">
                <?php echo $consultation["c_desc"]; ?>
            </div>
            <div class="panel-footer">
                <h3><?php echo "R" . $consultation["c_price"] . ".00"; ?></h3>
            </div>
        </div>
        
    </div>
    
</div>
<?php include("footer.php"); ?>