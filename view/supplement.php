<?php include("header.php"); ?>
<div class="container">

    <div class="row" style="margin-bottom: 50px;">
        
        <div class="col-md-4">
            
            <ul class="list-group">
                <li class="list-group-item active">Search Supplement</li>
                
                <li class="list-group-item">
                    <form class="form-inline">
                        <input type="text" class="form-control" id="search" placeholder="Search supplement..">
                        &nbsp;
                        <button class="btn btn-primary" id="search_btn">search</button>
                            
                    </form>
                </li>
            </ul>
            
            <br>
            <!-- Supplement Category Area -->
            <div id="get_category"></div>   
            
        </div>
        
        <!--
                <div class="col-sm-4">
                    <div class="card" style="margin-bottom: 2rem;">
                        <a href="#"><img class="card-img-top" src="../assets/images/sp2.jpg" alt="Supplement Image" width="259" height="180"></a>

                        <div class="card-body">
                            <h5 class="card-title">Name</h5>
                            <p class="card-text">R500.00</p>
                            <p style="font-size: 1vw; color: grey;">6 in stock</p>
                            <a href="#" class="btn btn-primary btn-sm">Add to Cart</a>
                            <a href="#" class="btn btn-warning btn-sm">View</a>
                        </div>
                    </div>
                </div>
                -->
                
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 col-xs-12" id="product_msg"></div>
            </div>
            <div class="row" >
                <div id="get_product"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <ul class="pagination justify-content-center" id="pageno" style="margin-left: auto; margin-right: auto;">
            <!--<li class="page-item">
                <a class="page-link" href="#">1</a>
            </li>-->

        </ul>
    </div>
</div>
<?php include("footer.php"); ?>