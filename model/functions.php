<?php
include("db.php");

function get_supplement_categories(){
    global $con;
    $result = $con->query("SELECT * FROM supplement_category");
    return $result;
}

function get_three_supplement(){
    global $con;
    $result = $con->query("SELECT * FROM supplement ORDER BY supplement_id DESC LIMIT 3");
    return $result;
}

function get_consultation_categories(){
    global $con;
    $result = $con->query("SELECT * FROM consultation");
    return $result;
}

function get_a_consultation($id){
    global $con;
    $result = $con->query("SELECT * FROM consultation WHERE c_id = '$id'")->fetch();
    return $result;
}

function get_booking_slot_count($date, $time) {
    $con = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $date = new DateTime('tomorrow'); $date = $date->format('Y-m-d');
    $result = $con->query("SELECT COUNT(*) FROM booking WHERE booking_date = '$date' and booking_time = '$time'");
    $sum = $result->fetchColumn();
    if($sum > 0){
        $sum = $sum;
    }else{
        $sum = "0";
    }
    return $sum;
}

function get_total_booking_allowed_per_slot($date, $time) {
    $con = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $result = $con->query("SELECT COUNT(*) FROM booking WHERE booking_date = '$date' AND booking_time = '$time';");
    return $result->fetchColumn();
}

function get_consultation_price($id) {
    $con = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $result = $con->query("SELECT c_price FROM consultation WHERE c_id = '$id'");
    return $result->fetchColumn();
}

function get_consultation($id) {
    $con = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $result = $con->query("SELECT c_name FROM consultation WHERE c_id = '$id'");
    return $result->fetchColumn();
}

function get_name($id) {
    $con = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $result = $con->query("SELECT user_surname FROM user WHERE user_id = '$id'");
    return $result->fetchColumn();
}

function get_email($id) {
    $con = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $result = $con->query("SELECT user_email FROM user WHERE user_id = '$id'");
    return $result->fetchColumn();
}


function booked_already_for_tomorrow($id, $date){
    global $con;
    $result = $con->query("SELECT COUNT(*) FROM booking WHERE user_id = '$id' AND booking_date = '$date'");
    return $result->fetchColumn();
}

function create_booking($booking_id, $booking_date, $booking_time, $user_id, $c_id, $booking_status, $booking_price){
    global $con;
    $result = $con->exec("INSERT INTO `booking`(`booking_id`, `booking_date`, `booking_time`, `user_id`, `c_id`, `booking_status`, `booking_price`) VALUES "
            . "('$booking_id', '$booking_date', '$booking_time', '$user_id', '$c_id', '$booking_status', '$booking_price');");
    return $result;
}

function create_booking_invoice($invoice_id, $invoice_date, $invoice_total, $user_id, $status, $is_booking){
    global $con;
    $result = $con->exec("INSERT INTO `invoice`(`invoice_id`, `invoice_date`, `invoice_total`, `user_id`, `status`, `is_booking`) VALUES "
            . "('$invoice_id', '$invoice_date', '$invoice_total', '$user_id', '$status', '$is_booking')");
    return $result;
}


function is_registered($id){
    global $con;
    $result = $con->query("SELECT * FROM user WHERE user_id = '$id'");
    if($result->rowCount() > 0){
        return true;
    }
    return false;
}

function is_email_valid($email){
    global $con;
    $result = $con->query("SELECT * FROM user WHERE user_email = '$email'");
    return $result;
}

function register_user($user_id, $user_name, $user_surname, $user_tel_h, $user_tel_w, $user_tel_c, $user_addres, $user_gender, $user_dob, $user_email){
    global $con;
    $result = $con->exec("INSERT INTO `user`(`user_id`, `user_name`, `user_surname`, `user_tel_h`, `user_tel_w`, `user_tel_c`, `user_address`, `user_gender`, `user_dob`, `user_email`) VALUES "
            . "('$user_id', '$user_name', '$user_surname', '$user_tel_h', '$user_tel_w', '$user_tel_c', '$user_addres', '$user_gender', $user_dob, '$user_email')");
    return $result;
}


//////////////////////////////////////admin functions //////////////////////////////////////////
function admin_login($email, $password){
    global $con;
    //$user_password = md5($user_password);
    $result = $con->query("SELECT * FROM hcp WHERE hcp_email = '$email' AND hcp_password = '$password' LIMIT 1");
    return $result->fetch();
}


function daily_income(){
    $conn = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $query = "SELECT SUM(invoice_total) FROM invoice WHERE invoice_date = CURRENT_DATE;";
    $result = $conn->query($query)->fetchColumn();
    if($result > 0){
        $sum = $result;
    }else{
        $sum = "0.00";
    }
    return $sum;
}

// function to calculate weekly income
function weekly_income(){
    $conn = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $query = "SELECT SUM(invoice_total) FROM invoice WHERE WEEK(invoice_date) = WEEK(CURRENT_DATE);";
    $result = $conn->query($query)->fetchColumn();
    if($result > 0){
        $sum = $result;
    }else{
        $sum = "0.00";
    }
    return $sum;
}

// function to calculate monthly income
function monthly_income(){
    $conn = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $query = "SELECT SUM(invoice_total) FROM invoice WHERE MONTH(invoice_date) = MONTH(CURRENT_DATE);";
    $result = $conn->query($query)->fetchColumn();
    if($result > 0){
        $sum = $result;
    }else{
        $sum = "0.00";
    }
    return $sum;
}

function month_birthday(){
    $conn = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $query = "SELECT * FROM user WHERE MONTH(user_dob) = MONTH(CURRENT_DATE);";
    $result = $conn->query($query);
    return $result;
}


function sum_each_month_payment($month_number){
    $con = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $result = $con->query("SELECT SUM(invoice_total) FROM invoice WHERE MONTH(invoice_date) = '$month_number'");
    return $result->fetchColumn();
}

function get_bookings(){
    global $con;
    $result = $con->query("SELECT * FROM booking");
    return $result;
}


function get_supplements(){
    global $con;
    $result = $con->query("SELECT * FROM supplement");
    return $result;
}

function get_moderate_stock(){
    global $con;
    $query = "SELECT * FROM supplement WHERE qty > 10";
    $rows = $con->query($query);
    return $rows;
}

function get_low_stock(){
    global $con;
    $query = "SELECT * FROM supplement WHERE qty < 9";
    $rows = $con->query($query);
    return $rows;
}

function get_out_of_stock(){
    global $con;
    $query = "SELECT * FROM supplement WHERE qty < 1";
    $rows = $con->query($query);
    return $rows;
}

function get_admin_user($id){
    global $con;
    $query = "SELECT * FROM hcp WHERE hcp_id = '$id'";
    $rows = $con->query($query);
    return $rows->fetch();
}

function get_supplement_by_id($id){
    $con = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $result = $con->query("SELECT * FROM supplement WHERE supplement_id = '$id'");
    return $result->fetch();
}

function get_supplement_name($id){
    $con = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $result = $con->query("SELECT supplement_name FROM supplement WHERE supplement_id = '$id'");
    return $result->fetchColumn();
}

function get_supplement_img($id){
    $con = new PDO("mysql:host=localhost;dbname=botlokwa", "root", "");
    $result = $con->query("SELECT supplement_img FROM supplement WHERE supplement_id = '$id'");
    return $result->fetchColumn();
}

function get_user($id){
    global $con;
    $query = "SELECT * FROM user WHERE user_id = '$id'";
    $rows = $con->query($query);
    return $rows->fetch();
}

