<?php include 'login-header.php'; ?>
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Botlokwa Administration Login</div>
        <div class="card-body">
           <div class="col-sm-12">
                <?php if(isset($message)){echo $message; }else{ echo ""; } ?>
            </div>
            
            <center>
               <img src="../assets/images/botlokwa.png" alt="Logo" style="border-radius: 10px;" width="150" height="150" class="img-responsive"/> 
            </center>
            
            <form action="index.php?action=login" method="post">
                
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" autofocus="autofocus">
                        <label for="inputEmail">Email address</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                        <label for="inputPassword">Password</label>
                    </div>
                </div>
                
                <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg">LOGIN</button>
            </form>
        </div>
    </div>
</div>
<?php include 'login-footer.php'; ?>