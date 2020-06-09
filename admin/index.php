<?php
// session start
session_start();

// require the models
require ("../model/db.php");
require ("../model/functions.php");

// get the required action
$action = filter_input(INPUT_POST, "action");
if ($action == null) {
    $action = filter_input(INPUT_GET, "action");
    //if ($action == null) {
      //  $action = "login";
    //}
}

switch ($action){
    case "index":
        header("Location: ../index.php");
        break;
    case "home":
        include("../admin/view/home.php");
        break;
    case "login":
        // if the submission button is clicked 
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            // get form credentials 
            @$email = $_POST["email"];
            @$password = $_POST["password"];
            
            // check empty fields
            if (empty($email) || empty($password)) {
                $message = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                        . "Fill all fields.</div>";
                include("../admin/view/login.php");
                exit();
            }

            $admin = admin_login($email, $password);
            
            if ($admin > 0) {
                // login the user
                $_SESSION["authenticated"] = true;
                $_SESSION["id"] = $admin["hcp_id"];
                $_SESSION["name"] = $admin["hcp_name"];

                // get the list of birthdays 
                $birthdays = month_birthday();
                include("../admin/view/home.php");
                exit();
                
            } else {
                // if the login is not successful 
                $message = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                        . "Invalid credentails. Try again.</div>";
                include("../admin/view/login.php");
                exit();
            }
        }
        break;
    case "supplements":
        
        // get the list of supplements 
        $sups = get_supplements();
        include("../admin/view/supplements.php");
        exit();
        break;
    case "supplement_add":
        if($_SERVER["REQUEST_METHOD"] === "POST"){
            @$category = $_POST["category"];
            @$name = $_POST["name"];
            @$desc = $_POST["desc"];
            @$price = $_POST["price"];
            // image uploading 
            $image = $_FILES["image"];
            $fileName = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fileError = $_FILES['image']['error'];
            $fileType = $_FILES['image']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'pdf', 'txt');

            if(in_array($fileActualExt, $allowed)){
                    if($fileError === 0){
                            //if($filesize < 1000000){
                                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                                    $fileDestination = '../assets/images/'.$fileNameNew;
                                    move_uploaded_file($fileTmpName, $fileDestination);
                            //} else {
                            //	echo "<script>alert('Your file is too big')</script>";
                            //}
                    } else {
                            echo "<script>alert('Error uploading the file')</script>";
                    }

            } else {
                    echo "<script>alert('Your file is not allowed')</script>";
            }
            @$qty = $_POST["qty"];
            $query = "INSERT INTO `supplement`(`supplement_id`, `supplement_cat_id`, `supplement_name`, `supplement_descr`, `supplement_price`, `supplement_img`, `qty`) VALUES "
                    . "('NULL','$category','$name','$desc','$price','$fileNameNew','$qty')";
            $res = $con->exec($query);
            if(isset($res)){
                $message = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>"
                            . "<strong>Supplement added</strong>.</div>";

            }

            $sups = get_supplements();
            include("../admin/view/supplements.php");
        }
        exit();
        break;
    case "charts":
        $query = "SELECT DISTINCT invoice_date FROM invoice ORDER BY invoice_date ASC;";
        $result = $con->query($query);
        //$chart_data = '';
        $monthNameArray = [];
        $monthTotalArray = [];
        foreach ($result as $res) {
            $date = $res["invoice_date"];
            $date = new DateTime($date);
            $month_name = $date->format("M");
            $month_number = $date->format("m");
            
            $monthTotalArray[] = sum_each_month_payment($month_number);
            $monthNameArray[] = $month_name;
        }
        include("../admin/view/charts.php");
        exit(); 
        break;
    case "bookings":
        $bookings = get_bookings();
        include("../admin/view/booking.php");
        break;
    
    case "complete":
        @$id = $_GET["id"];
        $query = "UPDATE booking SET booking_status = 'Completed' WHERE booking_id = '$id'";
        $row = $con->exec($query);
        $bookings = get_bookings();
        $message = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                    . "Booking completed.</div>";
        include("../admin/view/booking.php");
        break;
    case "delete":
        @$id = $_GET["id"];
        $query = "DELETE FROM booking WHERE booking_id = '$id'";
        $row = $con->exec($query);
        $bookings = get_bookings();
        $message = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                    . "Booking cancelled.</div>";
        include("../admin/view/booking.php");
        break;
    
    case "stock_control":
        $moderate = get_moderate_stock();
        $low = get_low_stock();
        $out = get_out_of_stock();
        
        include("../admin/view/stock-control.php");
        break;
    case "admin":
        $user = get_admin_user($_SESSION["id"]);
        include("../admin/view/admin.php");
        break;
    case "logout":
        session_destroy();
        header("Location: ../index.php");
        break;
    default :
        include("../admin/view/login.php");
        break;
}

?>