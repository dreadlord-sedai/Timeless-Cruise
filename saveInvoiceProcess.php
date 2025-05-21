<?php

session_start();
include "connection.php";

if($_SESSION["u"]){

    $order_id = $_POST["o"];
    $pid = $_POST["i"];
    $mail = $_POST["m"];
    $amount = $_POST["a"];
    $qty = $_POST["q"];
    $size = $_POST["s"];
    $ors = $_POST["os"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='".$pid."'");
    $product_data = $product_rs->fetch_assoc();

    $current_qty = $product_data["product_qty"];
    $new_qty = $current_qty - $qty;

    Database::iud("UPDATE `product` SET `product_qty`='".$new_qty."' WHERE `product_id`='" . $pid . "'");

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    Database::iud("INSERT INTO `invoice` (`order_id`,`order_date`,`total`,`order_qty`,`o_size`,`order_status`,
    `product_product_id`,`user_email`) VALUES('".$order_id."','".$date."','".$amount."','".$qty."',
    '".$size."','".$ors."','".$pid."','".$mail."')");

    echo("success");

}else{
    echo ("Please Login To Your Account");
}
?>