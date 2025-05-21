<?php

include "connection.php";

if(isset($_GET["id"])){
    $rap_id = $_GET["id"];

    //? Delete Product Image
    $rimg_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id`='".$rap_id."'");
    $rimg_num = $rimg_rs->num_rows;

    if($rimg_num > 0 || $rimg_num == 0){
        Database::iud("DELETE FROM `product_img` WHERE `product_product_id`='" . $rap_id . "'");
    }

    //? Delete Watchlist
    $rwp_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_product_id`='" . $rap_id . "'");
    $rwp_num = $rwp_rs->num_rows;

    if ($rwp_num == 0 || $rwp_num > 0) {
        Database::iud("DELETE FROM `watchlist` WHERE `product_product_id`='" . $rap_id . "'");
    }

    //? Delete FeedBack
    $rfp_rs = Database::search("SELECT * FROM `feedback` WHERE `product_product_id`='" . $rap_id . "'");
    $rfp_num = $rfp_rs->num_rows;

    if ($rfp_num == 0 || $rfp_num > 0) {
        Database::iud("DELETE FROM `feedback` WHERE `product_product_id`='" . $rap_id . "'");
    }

    //? Delete Cart
    $rcp_rs = Database::search("SELECT * FROM `cart` WHERE `cart_product_product_id`='" . $rap_id . "'");
    $rcp_num = $rcp_rs->num_rows;

    if ($rcp_num == 0 || $rcp_num > 0) {
        Database::iud("DELETE FROM `cart` WHERE `cart_product_product_id`='" . $rap_id . "'");
    }

    //? Delete Invoice
    $rip_rs = Database::search("SELECT * FROM `invoice` WHERE `product_product_id`='" . $rap_id . "'");
    $rip_num = $rip_rs->num_rows;

    if ($rip_num == 0 || $rip_num > 0) {
        Database::iud("DELETE FROM `invoice` WHERE `product_product_id`='" . $rap_id . "'");
    }

    //? Finaly Delete Product
    $rap_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='".$rap_id."'");
    $rap_num = $rap_rs->num_rows;

    if($rap_num == 0){
        echo ("Something Wrong, Try again Later");
    }else{
        Database::iud("DELETE FROM `product` WHERE `product_id`='".$rap_id."'");
    }

    echo ("success");
}

?>