<?php

session_start();
include "connection.php";

if(isset($_SESSION["u"])){

    $email = $_SESSION["u"]["email"];
    $pid = $_POST["p"];
    $feedback = $_POST["f"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `feedback`(`feedback_date`,`feedback_msg`,`customer_email`,`product_product_id`)
    VALUES ('".$date."','".$feedback."','".$email."','".$pid."')");

    echo("success");

}else{
    echo("Please Login To Your Account");
}
?>