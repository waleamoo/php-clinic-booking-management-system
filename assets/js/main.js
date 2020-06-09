$(document).ready(function(){
   //alert('Ok');
   cat();
   // gets the list of categories
   function cat(){
      $.ajax({
         url: "/model/action.php",
         method: "POST",
         data: {category:1},
         success: function(data){
             $("#get_category").html(data);
         }
      })
   }
   
   // get the products
   product();
   function product(){
      $.ajax({
         url: "/model/action.php",
         method: "POST",
         data: {getProduct:1},
         success: function(data){
             $("#get_product").html(data);
         }
      })
   }
   
   // fetch products by category 
   $("body").delegate(".category", "click", function(event){
       $("#get_product").html("<h3>Loading...</h3>");
       event.preventDefault();
       var cid = $(this).attr("cid");
       //alert(cid);
       $.ajax({
         url: "/model/action.php",
         method: "POST",
         data: {get_selected_category:1,cat_id:cid},
         success: function(data){
             $("#get_product").html(data);
             if($("body").width() < 480){
                $("body").scrollTop(683);
            }
         }
       })
   })
   
   // search functionality
   $("#search_btn").click(function(e){
       e.preventDefault();
       $("#get_product").html("<h3>Loading...</h3>");
       var keyword = $("#search").val();
       if(keyword != ""){
           $.ajax({
            url: "/model/action.php",
            method: "POST",
            data: {search:1,keyword:keyword},
            success: function(data){
                $("#get_product").html(data);
                if($("body").width() < 480){
                    $("body").scrollTop(683);
                }
            }
          })
       }
   })
   
   // pagination functions 
   page();
   function page(){
       $.ajax({
        url: "/model/action.php",
        method: "POST",
        data: {page:1},
        success: function(data){
            $("#pageno").html(data);  
        }
      })
   }
   
   $("body").delegate("#page", "click", function(){
       var pn = $(this).attr("page");
       //alert(pn);
       $.ajax({
        url: "/model/action.php",
        method: "POST",
        data: {getProduct:1,setPage:1,pageNumber:pn},
        success: function(data){
            $("#get_product").html(data);  
        }
      })
   })
   
   //////////////////CART FUNCTIONS////////////////////
   // add product to cart 
   $("body").delegate("#product", "click", function(event){
       event.preventDefault();
       //alert(0);
       var p_id = $(this).attr("pid");
       //alert(pid);
       $.ajax({
        url: "/model/action.php",
        method: "POST",
        data: {addProduct:1,proId:p_id},
        success: function(data){
             $("#product_msg").html(data);
             cart_count();
        }
      })
   })
   
   // code to view the product 
   // $("#product_view").click(function(e){
   //$("body").delegate("#view", "click", function(event){
       //event.preventDefault();
       //alert("ok");
	   
	   /*
	   var p_id = $(this).attr("pid");
       //alert(pid);
       $.ajax({
        url: "/model/action.php",
        method: "POST",
        data: {viewProduct:1,proId:p_id},
        success: function(data){
             $("#get_product").html(data);
        }
      })
	  
	  */
       
   //});
   
   // cart count 
   cart_count();
    function cart_count(){
        $.ajax({
            url : "/model/action.php",
            method : "POST",
            data : {cart_count:1},
            success : function(data){
                $("#cart_count").html(data);
            }
        });
    }
    
    // view the cart 
    cart_view();
    function cart_view(){
        //event.preventDefault();
        $.ajax({
            url : "/model/action.php",
            method : "POST",
            data : {cart_view:1},
            success : function(data){
                $("#cart_view").html(data);
            }
        });
    }
    
    
    
    
    // JavaScript to remove the item from the cart
    $("body").delegate(".delete","click",function(event){ 
        event.preventDefault();
        var product_id = $(this).attr("delete_id");
        //alert(product_id);
        $.ajax({
        url : "/model/action.php",
        method : "POST",
        data : {deleteSupplement:1,product_id:product_id},
        success : function(data){
            $("#cart_msg").html(data);
            cart_view(); // update the display products
            cart_count(); // update the count of the cart
        }
    });
    });
    
    // js code for updates 
    $("body").delegate(".qty","keyup",function(){ 
        var product_id = $(this).attr("product_id");
        var quantity = $("#qty-"+product_id).val();
        var price = $("#price-"+product_id).val();
        var total = quantity * price;
        //alert(total);
        $("#total-"+product_id).val(total);
    });

    $("body").delegate(".update","click",function(event){
        event.preventDefault();
        var product_id = $(this).attr("update_id");
        var quantity = $("#qty-"+product_id).val();
        var price = $("#price-"+product_id).val();
        var total = $("#total-"+product_id).val();
        $.ajax({
            url : "/model/action.php",
            method : "POST",
            data : {updateSupplement:1,product_id:product_id,quantity:quantity,price:price,total:total},
            success : function(data){
                $("#cart_msg").html(data);
                cart_view(); // update the display products
            }
        });
    });
    
    // set the button visibility to false
    $("body").delegate("#door","click",function(){
        var total = $(this).attr("total");
        //alert('yes');
        var shipping = $(this).attr("door");
        //alert(total);

        // get the value of the radio button

        // if the radio button is cliked - run ajax request to store values in session
        $.ajax({
            url : "/model/action.php",
            method : "POST",
            data : {updateShipping:1,total:total,shipping:shipping},
            success : function(data){
                //location.reload();
                $("#shipping_msg").html(data);
                setInterval('location.reload()', 1000);  
            }
        });
        
    });

    $("body").delegate("#pickup","click",function(e){
        var total = $(this).attr("total");
        var shipping = $(this).attr("free");
        //alert('total' + total + ' ' + 'shpping' + shipping);
        $.ajax({
            url : "/model/action.php",
            method : "POST",
            data : {updateShipping:1,total:total,shipping:shipping},
            success : function(data){
                //location.reload();
                $("#shipping_msg").html(data);
                setInterval('location.reload()', 1000);  
            }
        });
    });
    
    // payment 
})