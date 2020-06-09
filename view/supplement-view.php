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
			
            
            
        </div>
                
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 col-xs-12" id="product_msg"></div>
            </div>
			
			<!-- searched supplement -->
            <div class="row" >
				<div class='col-sm-12'>
					<div class='card' style='margin-bottom:2rem;'>
						<a href='#'><img class='card-img-top' src='../assets/images/<?php echo $supplement["supplement_img"]; ?>' style='width:200px; height:180px;'></a>
						<div class='card-body' style='width:20rem;'>
							<h5 class='card-title'>$supplement_name</h5>
							<p class='card-text'>R$supplement_price.00</p>
							<p style='font-size:20px;color:grey;'>$qty in stock</p>
							<button pid='$supplement_id' id='product' href='#' class='btn btn-primary btn-sm'>Add to Cart</button>
							<a href='?action=view_sup?id=$supplement_id' pid='$supplement_id' href='#' class='btn btn-warning btn-sm'>View</a>
						</div>
					</div>
				</div>
				
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