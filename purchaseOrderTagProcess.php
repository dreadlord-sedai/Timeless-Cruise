<?php

include "connection.php";

if(isset($_GET["order_id"])){
    $oid = $_GET["order_id"];

    $porder_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='".$oid."'");
    $porder_num = $porder_rs->num_rows;

    if($porder_num == 1){
        $porder_data = $porder_rs->fetch_assoc();
        $status = $porder_data["order_status"];

        if($status == 1){
            Database::iud("UPDATE `invoice` SET `order_status`='2' WHERE `order_id`='" . $oid . "'");
            echo("package delivered");
        }else if($status == 2){
            Database::iud("UPDATE `invoice` SET `order_status`='1' WHERE `order_id`='" . $oid . "'");
            echo("package still not delivered");
        }
    }else{
        echo ("Cannot Find The Product Try again Later");
    }
}else{
    echo ("Something Went Wrong");
}

?>