<?php
// start the session
session_start();
// get connected to database 
include("db.php");
include("functions.php");

if (isset($_POST["category"])) {
    $result = $con->query("SELECT * FROM supplement_category");
    echo "<ul class='list-group'> 
                <li class='list-group-item active'>Supplement Categories</li>";
    foreach ($result as $res) {
        $category_id = $res["supplement_cat_id"];
        $category_name = $res["supplement_cat_name"];
        echo "<li class='list-group-item'><a href='#' cid='$category_id' class='category'>$category_name</a></li>";  
    }
    echo "</ul>";
}

// pagination set up 
if(isset($_POST["page"])){
    $count = $con->query("SELECT * FROM supplement")->rowCount(); // count of product in the database
    //echo $count;
    $pageno = ceil($count/9); // the number of pages 9 products can be displayed
    //echo $pageno;
	
	// if the pageno is > 9 then show pagination
	if($count > 9){
		for($i = 1; $i <= $pageno; $i++){
			echo "<li class='page-item'>
					<a class='page-link' href='#' id='page' page='$i'>$i</a>
				</li>";
		}
	}
}

// list the supplement with pagination 
if(isset($_POST["getProduct"])){
    // check for the page number 
    $limit = 9;
    if(isset($_POST["setPage"])){
        $pageno = $_POST["pageNumber"];
        $start = ($pageno * $limit) - $limit;
    }else{
        $start = 0;
    }
    
    $result = $con->query("SELECT * FROM supplement LIMIT $start, $limit");
    echo "<div class='row'>";
    foreach ($result as $res) {
        $supplement_id = $res["supplement_id"];
        $supplement_cat_id = $res["supplement_cat_id"];
        $supplement_name = $res["supplement_name"];
        $supplement_price = $res["supplement_price"];
        $supplement_img = $res["supplement_img"];
        $qty = $res["qty"];
        
        echo "<div class='col-sm-4'>
                <div class='card' style='margin-bottom:2rem;'>
                    <a href='#'><img class='card-img-top' src='../assets/images/$supplement_img' style='width:200px; height:180px;'></a>
                    <div class='card-body' style='width:20rem;'>
                        <h5 class='card-title'>$supplement_name</h5>
                        <p class='card-text'>R$supplement_price.00</p>
                        <p style='font-size:20px;color:grey;'>$qty in stock</p>
                        <button pid='$supplement_id' id='product' class='btn btn-primary btn-sm'>Add to Cart</button>
                        <button pid='$supplement_id' id='view_btn' class='btn btn-warning btn-sm'>View</button>
                    </div>
                </div>
            </div>";
    }
    echo "</div>";
}

// get product by the selected category
if(isset($_POST["get_selected_category"]) || isset($_POST["search"]) || isset($_POST["viewProduct"])){
    if(isset($_POST["get_selected_category"])){
        $cid = $_POST["cat_id"];
        $result = $con->query("SELECT * FROM supplement WHERE supplement_cat_id = '$cid'");
    }else if(isset ($_POST["search"])){
        $keyword = $_POST["keyword"];
        $result = $con->query("SELECT * FROM supplement WHERE supplement_name LIKE '%$keyword%'");
    } else if(isset($_POST["viewProduct"])){
		$id = $_POST["p_id"];
		$result = $con->query("SELECT * FROM supplement WHERE supplement_id = '$id'");
		$res = $result->fetch();
		
		echo "<div class='row'>";
		
		$supplement_id = $res["supplement_id"];
        $supplement_cat_id = $res["supplement_cat_id"];
        $supplement_name = $res["supplement_name"];
        $supplement_price = $res["supplement_price"];
        $supplement_img = $res["supplement_img"];
		$supplement_descr = $res["supplement_descr"];
        $qty = $res["qty"];
		echo "<div class='col-sm-12'>
                <div class='card' style='margin-bottom:2rem;'>
                    <a href='#'><img class='card-img-top' src='../assets/images/$supplement_img' style='width:200px; height:180px;'></a>
                    <div class='card-body' style='width:20rem;'>
                        <h5 class='card-title'>$supplement_name</h5>
                        <p class='card-text'>R$supplement_price.00</p>
                        <p style='font-size:20px;color:grey;'>$qty in stock</p>
						<p>$supplement_descr</p>
                        <button pid='$supplement_id' id='product' class='btn btn-primary btn-lg'>Add to Cart</button>
                    </div>
                </div>
            </div>";
		
		echo "</div>";
		return; // or exit();
	}
	
    
    echo "<div class='row'>";
    if($result->rowCount() > 0){
        echo "<div class='row'>";
    foreach ($result as $res) {
        $supplement_id = $res["supplement_id"];
        $supplement_cat_id = $res["supplement_cat_id"];
        $supplement_name = $res["supplement_name"];
        $supplement_price = $res["supplement_price"];
        $supplement_img = $res["supplement_img"];
        $qty = $res["qty"];
		
        echo "<div class='col-sm-4'>
                <div class='card' style='margin-bottom:2rem;'>
                    <a href='#'><img class='card-img-top' src='../assets/images/$supplement_img' style='width:200px; height:180px;'></a>
                    <div class='card-body' style='width:20rem;'>
                        <h5 class='card-title'>$supplement_name</h5>
                        <p class='card-text'>R$supplement_price.00</p>
                        <p style='font-size:20px;color:grey;'>$qty in stock</p>
                        <button pid='$supplement_id' id='product' class='btn btn-primary btn-sm'>Add to Cart</button>
                        <button pid='$supplement_id' id='view_btn' class='btn btn-warning btn-sm'>View</button>
                    </div>
                </div>
            </div>";
    }
    echo "</div>";
    }else{
        echo "<p class='display-4'>No supplement.</p>";
    }
    echo "</div>";
}

// add the product to the cart
if(isset($_POST["addProduct"])){
    // start a session if it is not started 
    if(!isset($_SESSION["session_id"])){
        $_SESSION["session_id"] = mt_rand(0, 10000);
    }
    
    if(!isset($_SESSION["user_id"])){
        $_SESSION["user_id"] = mt_rand(0, 10000);
    }
    
    $supplement_id = $_POST["proId"];
    $user_id = $_SESSION["user_id"]; 
    
    // check if product has been added before 
    $query = "SELECT * FROM cart WHERE supplement_id = '$supplement_id' AND (user_id = '" . $_SESSION["user_id"] . "' OR session_id = '" . $_SESSION["session_id"] . "')";
    $row = $con->query($query);
    if ($row->rowCount() > 0) {
        echo "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Supplement already in cart.</b></div>";
    } else {
        // add the supplement newly to the cart 
        $query = "SELECT * FROM supplement WHERE supplement_id = '$supplement_id'";
        $row = $con->query($query)->fetch();
        $supplement_id = $row["supplement_id"];
        $supplement_name = $row["supplement_name"];
        $supplement_price = $row["supplement_price"];
        $supplement_img = $row["supplement_img"];
        $session_id = $_SESSION["session_id"];
        $user_id = $_SESSION["user_id"];
        
        // insert the new supplement into the cart
        $query = "INSERT INTO `cart`(`cart_id`, `supplement_id`, `user_id`, `qty`, `price`, `total`, `session_id`) VALUES "
                . "(NULL,'$supplement_id','$user_id','1','$supplement_price','$supplement_price', '$session_id')";
        $row = $con->exec($query);
        echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Supplement added.</b></div>";   
    }  
}

// get the count of the cart items 
if (isset($_POST["cart_count"])) {
    @$user_id = $_SESSION["user_id"];
    @$session_id = $_SESSION["session_id"];
    
    $query = "SELECT * FROM cart WHERE user_id = '$user_id' AND session_id = '$session_id'";
    $row = $con->query($query)->rowCount();
    if($row < 1){
        echo "0";
    } else {
        echo $row;
    }
}

// get the cart view 
if (isset($_POST["cart_view"])) {
    if(!isset($_SESSION["user_id"])){
        $_SESSION["user_id"] = mt_rand(1, 10000);
    }
    
    if(!isset($_SESSION["session_id"])){
        $_SESSION["session_id"] = mt_rand(1, 10000);
    }
    
    $no = 0;
    $total_amt = 0;
    
    $query = "SELECT * FROM cart WHERE user_id = '" . $_SESSION["user_id"] . "' AND session_id = '" . $_SESSION["session_id"] . "'";
    $row = $con->query($query);
      
    if($row->rowCount() > 0){
        echo "<div class='row'>
                    <div class='col-sm-12 border' style='padding-bottom: 5px; margin-bottom: 15px;'> 
                       
                        <div class='row border'>
                            <div class='col-1'>S/N</div>
                            <div class='col-1'>Image</div>
                            <div class='col-2'>Name</div>
                            <div class='col-1'>Price(R)</div>
                            <div class='col-1'>Quantity</div>
                            <div class='col-3 text-center'>Total</div>
                            <div class='col-2'>&nbsp;</div>
                        </div>
                        <br>
                        ";
        foreach ($row as $rows){
            // get all data 
            $supplement_id = $rows["supplement_id"]; 
            $supplement_name = get_supplement_name($supplement_id); 
            $supplement_img = get_supplement_img($supplement_id);
            $qty = $rows["qty"];
            $price = $rows["price"];
            $total = $rows["total"];
            $no = $no + 1;
            
            
            $price_array = array($total);
            $total_sum = array_sum($price_array);
            @$total_amt = $total_amt + $total_sum;
            
            $_SESSION["total"] = $total_amt; // store the session total in a session 
            
            echo "<div class='row'>
                        <div class='col-1'>
                            $no
                        </div>
                        <div class='col-1'>
                            <img src='../assets/images/$supplement_img' alt='supplement image' width='50' height='70' />
                        </div>
                        <div class='col-2'>
                            $supplement_name
                        </div>
                        <div class='col-1'>
                            <input type='text' value='$price' class='form-control-sm price' product_id='$supplement_id' id='price-$supplement_id' readonly size='6'>
                        </div>
                        <div class='col-1'>
                            <input type='text' value='$qty' class='form-control-sm qty' product_id='$supplement_id' id='qty-$supplement_id' size='1' />
                        </div>
                        <div class='col-3 text-center'>
                            <input type='text' value='$total' class='form-control-sm total' product_id='$supplement_id' id='total-$supplement_id' readonly size='7'>
                        </div>
                        <div class='col-2'>
                            <a href='#'><i class='fas fa-trash-alt fa-2x delete' delete_id='$supplement_id' title='delete'></i></a> 
                            &nbsp; 
                            <a href='#'><i class='fas fa-check fa-2x update' update_id='$supplement_id' title='update'></i></a>
                        </div>
                    </div>
                ";

        }
        
   
        
        echo "
            <div class='row' style='float:right; padding-right: 5px; margin-bottom: 10px;'>
               Grand Total: <input type='text' class='form-control-sm' value='R$total_amt.00' id='cartTotal' readonly >
            </div>
            
            <div class='row' style='float:right; clear:right; padding-right: 5px;'>
               <a href='?action=cart_checkout' class='btn btn-success btn-lg'>Checkout Cart</a>
            </div>
            </div>
            ";
        
        
    } else {
        echo "<div class='alert alert-danger text-center'>
                <h2>Empty cart.</h2>
            </div>";  
    }
}

if (isset($_POST["deleteSupplement"])) {
    $supplement_id = $_POST["product_id"];
    @$user_id = $_SESSION["user_id"];
    $session_id = $_SESSION["session_id"];
    
    $query = "DELETE FROM cart WHERE supplement_id = '$supplement_id' AND (user_id = '$user_id' AND session_id = '$session_id')";
    $row = $con->exec($query);
    echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Supplement deleted.</b></div>";
}

if (isset($_POST["updateSupplement"])) {
    $supplement_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $total = $_POST["total"];
    @$user_id = $_SESSION["user_id"];
    @$session_id = $_SESSION["session_id"];
    
    $query = "UPDATE cart SET qty = '$quantity', price = '$price', total = '$total' WHERE supplement_id = '$supplement_id' AND (user_id = '$user_id' AND session_id = '$session_id')";
    $row = $con->exec($query);
    echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Supplement updated.</b></div>";
    
}

// update the shipping cost 
if(isset($_POST['updateShipping'])){
    $total = $_POST["total"];
    $shipping = $_POST["shipping"];

    $_SESSION['shipping'] = $shipping;
    $_SESSION['shipping_plus_total'] = $_SESSION['shipping'] + $_SESSION['total'];

    echo "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Shipping updated.</div>";
}



?>