<?php
session_start(); 

// require the models
require ("model/db.php");
require ("model/functions.php");

// get the required action
//$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//$url_array = explode("/", $url);
//$action = end($url_array);
$action = filter_input(INPUT_POST, "action");
if ($action == null) {
    $action = filter_input(INPUT_GET, "action");
    if ($action == null) {
        $action = "index";
    }
}


switch ($action){
    case "index":
        $sups = get_three_supplement();
        include("view/index.php");
        break;
    case "about":
        include("view/about.php");
        break;
    case "register":
        include("view/register.php");
        break;
    case "consultation-details":
        $id = $_GET["id"];
        // get the consultation using its id
        $consultation = get_a_consultation($id);
        include("view/consultation-details.php");
        break;
    case "consultation":
        // unset sessions
        session_destroy();
        $categories = get_consultation_categories();
        include("view/consultation.php");
        break;
    case "register_user":
        $id = $_POST["id"];
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $tel_h = $_POST["tel_h"];
        $tel_w = $_POST["tel_w"];
        $tel_c = $_POST["tel_c"];
        $dob = date("Y-m-d", strtotime($_POST["dob"]));
        $addr = $_POST["addr"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];

        // check empty fields
        if(empty($id)|| empty($first_name) || empty($last_name) || empty($tel_h) || empty($tel_c)|| empty($tel_w) || 
            empty($addr)  || empty($gender)  || empty($dob) ){
            $msg = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Please answer all fields.</div>";
            include("view/register.php");
            exit();
        }
        
        if(strlen($id) > 13){
            $msg = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>$id</b> is not a valid ID/Passport number.</div>";
            include("view/register.php");
            exit();
        }
        
        if(!is_numeric($tel_h) && strlen($tel_h) < 10 && strlen($tel_h) > 10){
            $msg = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>$tel_h</b> is not a valid phone number.</div>";
            include("view/register.php");
            exit();
        }
        
        if(!is_numeric($tel_w) && strlen($tel_w) < 10 && strlen($tel_w) > 10){
            $msg = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>$tel_w</b> is not a valid phone number.</div>";
            include("view/register.php");
            exit();
        }
        
        if(!is_numeric($tel_c) && strlen($tel_c) < 10 && strlen($tel_c) > 10){
            $msg = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>$tel_c</b> is not a valid phone number.</div>";
            include("view/register.php");
            exit();
        }
        
		/*
        if($password !== $confirm_password){
           $msg = "<div class='alert alert-warning'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> Password does not match.</div>";
            include("view/register.php");
            exit(); 
        }*/
        
        if(is_email_valid($email)->rowCount() > 0){
            $msg = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> $email already exists.</div>";
            include("view/register.php");
            exit(); 
        }
        
        if(is_registered($id)){
            $msg = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> $id already exists.</div>";
            include("view/register.php");
            exit(); 
        }
        
        $register  = register_user($id, $first_name, $last_name, $tel_h, $tel_w, $tel_c, $addr, $gender, $dob, $email);
        if(isset($register)){
            $msg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <b>Registration successful.</b></div>";
            include("view/register.php");
            exit(); 
        }
        break;
    case "book_consultation":
        session_status();
        // get form data
        @$id = $_POST["id"];
        @$service = $_POST["service"];
        @$time = $_POST["time"];
        $date = new DateTime('tomorrow'); $date = $date->format('Y-m-d');
        // validate if the user is registered
        if(!is_registered($id)){
            $msg = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                    . "We do have your registration. Please register with Heart Care Clinic.</div>";
            include("view/register.php");
            exit();
        }
        
        // validate if the user is allowed to book the selected time slot
        $count = get_total_booking_allowed_per_slot($date, $time);
        if($count > 5){
            $msg = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                    . "<strong>Sorry, $time is fully booked for tomorrow. Please choose another time.</strong>.</div>";
            $categories = get_consultation_categories();
            include("view/consultation.php");
            exit();
        }
        
        // validate if the same user has booked a consultation for tomorrow 
        
        if(booked_already_for_tomorrow($id, $date) > 0){
            $msg = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                    . "<strong>You have a pending book for tomorrow. No multiple bookings.</strong></div>";
            $categories = get_consultation_categories();
            include("view/consultation.php");
            exit();
        }
        
        // IF VALIDATION IS SUCCESSFUL SAVE BOOKING IN A SESSION
        $_SESSION["id"] = $id;
        $_SESSION["service_id"] = $service;
        $_SESSION["service_name"] = get_consultation($service);
        $_SESSION["time"] = $time;
        $_SESSION["date"] = $date;
        $_SESSION["price"] = get_consultation_price($service); 
        
        $msg = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                    . "<strong>Booking placed. Please confirm booking.</strong>.</div>";
        
        include("view/consultation-confirmation.php");
        break;
    case "confirm_booking":
        $date = new DateTime('tomorrow'); $date = $date->format('Y-m-d');
        if(booked_already_for_tomorrow($_SESSION["id"], $date) > 0){
            $msg = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                    . "<strong>No multiple bookings.</strong>.</div>";
        include("view/consultation-confirmation.php");
            exit();
        }
        // insert the user booking details into the database from the session variables 
        $insert = create_booking(null, $_SESSION["date"], $_SESSION["time"], $_SESSION["id"], $_SESSION["service_id"], "Pending", $_SESSION["price"]);
        $msg = "<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                    . "<strong>Booking confirmed. See you tomorrow.</strong>.</div>";
        include("view/consultation-confirmation.php");
        
        // create an invoice
        $invoice = create_booking_invoice(null, date('Y-md-d'), $_SESSION["price"], $_SESSION["id"], 'None', '1');
        
        // email user 
        $name = get_name($_SESSION["id"]);
        $email = null;
        $email .= "Hi $name, \nWe have recived your booking for an appointment with out doctor for " . $$_SESSION["time"] . " on " . $_SESSION["date"] .   "\n";
        // email them with the bought product
        $to = get_email($_SESSION["id"]);
        $subject = "Heart Care Booking Confirmation";
        $email .= "\nTotal: R" . $_SESSION["price"] . ".00\n\nThanks,\nHeart Care.\n\n";
        $from = 'admin@heartcare.co.za';
        $headers  = "Admin";
        
        mail($to, $subject, $email, $headers);
        
        break;
    case "delete_booking":
        unset($_SESSION["id"]);
        unset($_SESSION["service"]);
        unset($_SESSION["time"]);
        unset($_SESSION["date"]);
        unset($_SESSION["price"]);
        $msg = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> "
                    . "<strong>Booking deleted.</strong>.</div>";
        include("view/consultation-confirmation.php");
        break;
    case "logout":
        session_destroy();
        header("Location: ../index.php");
        break;
    case "supplement":
        include("view/supplement.php");
        exit(); 
        break;
    case "cart":
        include("view/cart.php");
        exit(); 
        break;
    case "cart_checkout":
        if(!isset($_SESSION["auth"])){
            $auth = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Please verify ID/Passport Number.</strong>.</div>";
            include("view/auth.php");
            exit();
        }
        
        include("view/shipping.php");
        break;
    case "auth_verify":
        @$id = $_POST["id"];
        $row = get_user($id);
        if($row > 0){
            // handshake for session user_id
            // change the session and update the cart items // and date is today for the future purpose 
            $_SESSION["user_id"] = $row["user_id"];
            $query = "UPDATE `cart` SET `user_id`= '" . $_SESSION["user_id"] . "' WHERE `session_id`= '" . $_SESSION["session_id"] . "'";
            $con->exec($query);    
            
            // set auth to true
            $_SESSION["auth"] = true;
            $auth = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Welcome" . $row["user_surname"] . ".</strong>.</div>";
            include("view/cart.php");
        }else{
            $msg = "<div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a> <strong>Please register to checkout.</strong>.</div>";
            include("view/register.php");
        }
        break;
    case "payment":
        include("view/payment.php");
        exit();
        break;
		
	case "view_sup":
		$id = $_GET["id"];
		$supplement = get_supplement_by_id($id);
		include("view/supplement-view.php");
        exit();
		break;
    case "post_payment":
        // save the order 
        
        

        break;
    default :
        include("view/index.php");
        break;
}

?>