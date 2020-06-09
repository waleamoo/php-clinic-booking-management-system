<?php include("header.php"); ?>
<div class="container">

    <div class="row" style="margin-bottom: 200px;">
        <div class="col-md-8 offset-md-2">
            <?php if(isset($auth)){ echo $auth; }else{ echo ""; } ?>
            
            <form action="index.php?action=auth_verify" method="POST">
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">ID Number/Passport Number</label>
                    <input id="name" type="text" class="form-control" name="id" placeholder="Enter ID/Passport Number" required >
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg">Verify</button>
            </form>
        </div>
    </div>

</div>