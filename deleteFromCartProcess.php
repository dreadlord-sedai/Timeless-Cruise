<?php

include "connection.php";

if(isset($_GET["id"])){

    Database::iud("DELETE FROM `cart` WHERE `cart_id`='".$_GET["id"]."'");
    echo ("Product Removed In Cart");

}else{
    echo ("Something Went Wrong");
}

?>