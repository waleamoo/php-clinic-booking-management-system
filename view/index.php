<?php include("header.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-12">
                    <img src="../assets/images/doctor.jpg" class="img-responsive img-thumbnail img-banner" alt="Hello Doctor" width="100%" height="auto" alt="Hello Doctor">
                    <a href="tel:+27012329099" type="submit" class="btn btn-danger btn-lg floating"><i class="fa fa-phone" aria-hidden="true"></i> Call Now </a>
                    <a href="?action=book_consultation" class="btn btn-success btn-lg floating2"><i class="fa fa-book" aria-hidden="true"></i> Book Appointment</a>
                    <strong class="lead">Welcome to the online platform</strong>
                    <br><br><br><br>
                </div>
            </div>
        
            <div class="row">
                <div class="col-sm-12">
                    <p>We are the providers of top-notch health care services in Limpopo. The health of the community is 
                        top-most priority as such, we provide the best doctors and health care practitioner money can buy to 
                        provide the community with the best health care services using the best technology and practices. 
                    </p>
                    <p>Few of the services we offer:</p>
                    <ul>
                        <li>Treatment for erectile dysfunction</li>
                        <li>Screening and treatment of sleep disorders</li>
                        <li>Family medicine</li>
                        <li>Private laboratory services</li>
                        <li>Check-up and consultation</li>
                        <li>Vaccination</li>
                        <li>Genetic profiling</li>
                        <li>Menopause and andropause treatment</li>
                        <li>Screening for sexually transmissible and blood-borne infections (STD / STBBI)</li>
                        <li>Liquid-based Pap Test (vaginal cytology), HPV screening</li>
                        <li>Psychology</li>
                        <li>Ear cleaning</li>
                        <li>Dental services and more...</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <img src="../assets/images/wecare.png" class="img-responsive img-thumbnail img-banner" alt="We Care" width="100%" height="auto" alt="We Care">
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-sm-12 text-content">
                    <div class="panel">
                        <div class="panel-head">
                            Latest Supplements in Stock
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <?php foreach($sups as $sup): ?>
                                <div class="col-sm-4">
                                    <div class="card" style="width: 18rem; margin-bottom: 5rem;">
                                        <a href="#"><img class="card-img-top" src="../assets/images/<?php echo $sup["supplement_img"]; ?>" alt="Supplement Image" width="259" height="180"></a>
                                        
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $sup["supplement_name"]; ?></h5>
                                            <p class="card-text">R<?php echo $sup["supplement_price"]; ?>.00</p>
                                            <p style="font-size: 1vw; color: grey;"><?php echo $sup["qty"]; ?> in stock</p>
                                            <!--
                                            <a href="#" class="btn btn-primary btn-sm">Add to Cart</a>
                                            <a href="#" class="btn btn-warning btn-sm">View</a> -->
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        </div>
    </div>
</div>
<?php include("footer.php"); ?>