<?php
include "connection.php";

$product_id = $_GET["id"];

$product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='".$product_id."'");

if($product_rs->num_rows == 1){
    $product_data = $product_rs->fetch_assoc();
    $status = $product_data["status_status_id"];

    if($status == 1){
        Database::iud("UPDATE `product` SET `status_status_id`='2' WHERE `product_id`='" . $product_id . "'");
        echo ("Deactivated");
    }else if($status == 2){
        Database::iud("UPDATE `product` SET `status_status_id`='1' WHERE `product_id`='" . $product_id . "'");
        echo ("Activated");
    }
}else{
    echo ("Something Went Wrong. Try Again later");
}
?>