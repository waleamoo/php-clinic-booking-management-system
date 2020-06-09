<?php include("header.php"); ?>
<div class="container">

    <div class="row" style="margin-bottom: 300px;">
        <div class="col-md-8 offset-md-2">
            <?php if(isset($msg)){ echo $msg; }else{ echo ""; } ?>
            <h2>Register with us.</h2>
            <small style="color: #ccc;">Heart care Clinic promises a second-to-none heart care services for all her patients. 
                That is what you enjoy when you register.</small>

            <form role="form" method="POST" action="index.php?action=register_user">
                
                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">ID Number/Passport Number</label>
                    <input id="name" type="text" class="form-control" name="id" placeholder="ID/Passport Number" value="<?php if(isset($id)){ echo $id; }else{ echo ""; } ?>">
                </div>

                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">First Name</label>
                    <input id="name" type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php if(isset($first_name)){ echo $first_name; }else{ echo ""; } ?>">
                </div>
                
                <div class="form-group">
                    <label for="last_name" class="col-md-4 control-label">Last Name/Surname</label>
                    <input id="name" type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php if(isset($last_name)){ echo $last_name; }else{ echo ""; } ?>">
                </div>

                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Telephone (Home)</label>

                    <input type="text" class="form-control" name="tel_h" placeholder="Home Phone" value="<?php if(isset($tel_h)){ echo $tel_h; }else{ echo ""; } ?>">

                </div>

                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Telephone (Work)</label>


                    <input type="text" class="form-control" name="tel_w" placeholder="Work Phone" value="<?php if(isset($tel_w)){ echo $tel_w; }else{ echo ""; } ?>">

                </div>

                <div class="form-group">
                    <label for="name" class="col-md-4 control-label">Telephone (Cell)</label>


                    <input type="text" class="form-control" name="tel_c" placeholder="Cell Phone" value="<?php if(isset($tel_c)){ echo $tel_c; }else{ echo ""; } ?>">

                </div>

                <div class="form-group">
                    <label for="reference" class="col-md-4 control-label">Reference</label>

                    <select name="reference" id="reference" class="form-control">
                        <option value="<?php if(isset($reference)){ echo $reference; }else{ echo ""; } ?>"><?php if(isset($reference)){ echo $reference; }else{ echo ""; } ?></option>
                        <option value="Facebook">Facebook</option>
                        <option value="Friends">Friends</option>
                        <option value="Instagram">Instagram</option>
                        <option value="Twitter">Twitter</option>
                        <option value="Internet">Internet</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dob" class="col-md-4 control-label">Date of Birth</label>
                    <div id="myDate">
                    </div>
                    <input type="date" name="dob" class="form-control" value="<?php if(isset($dob)){ echo $dob; }else{ echo ""; } ?>">
                    <!-- name="dob" class="form-control datepicker" -->
                </div>

                <div class="form-group">
                    <label for="addr" class="col-md-4 control-label">Home Address</label>

                    <input id="addr" type="text" class="form-control" name="addr" placeholder="99 Church Gardens, 99 Church Street, Johannesburg" value="<?php if(isset($addr)){ echo $addr; }else{ echo ""; } ?>">
                </div>

                <div class="form-group">
                    <label for="gender" class="col-md-4 control-label">Gender</label>
                    <div class="col-sm-6">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="M" checked>
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="F">
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" placeholder="example@example.com" value="<?php if(isset($email)){ echo $email; }else{ echo ""; } ?>">
                </div>

                <button type="submit" class="btn btn-primary btn-lg">Register</button>
            </form>
        </div>
    </div>

</div>
<?php include("footer.php"); ?>