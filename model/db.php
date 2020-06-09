<?php

$dsn = "mysql:host=localhost;dbname=botlokwa";
$user = "root";
$paswd = "";

try{
    $con = new PDO($dsn, $user, $paswd);
} catch (PDOException $ex){
    $error = $ex->getMessage();
    include("view/404.php");
    exit();
}

?>