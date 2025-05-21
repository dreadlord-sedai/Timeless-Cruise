<?php

session_start();
include "connection.php";

if(isset($_SESSION["u"])){

    $pid = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["email"];

    $array;

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `brand_has_model` ON
    product.brand_has_model_model_has_brand_id=brand_has_model.model_has_brand_id INNER JOIN 
    `brand` ON brand_has_model.brand_brand_id=brand.brand_id INNER JOIN `model` ON
    brand_has_model.model_model_id=model.model_id WHERE `product_id`='" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

    $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON
    user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
    city.district_district_id=district.district_id WHERE `user_email`='".$umail."'");
    $address_num = $address_rs->num_rows;

    if($address_num == 1){

        $address_data = $address_rs->fetch_assoc();

        $address = $address_data["address"];
        $delivery ="0";
        $ostatus = "1";

        if($address_data["district_id"] == 5){
            $delivery = $product_data["delevery_fee_colombo"];
        }else{
            $delivery = $product_data["delevery_fee_other"];
        }

        $price = $product_data["product_price"];
        $size =$product_data["model_name"];
        $items = $product_data["product_title"];
        $amount = ((int)$price*(int)$qty) +(int)$delivery;

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $uaddress = $address;
        $usize = $size;
        $city = $address_data["city_name"];

        $merchant_id = "1226262";
        $merchant_secret = "MTI5OTQ4NjUwNjI0MDgzNjM1MDgxMTkxMDQyOTAwNDg4Mjk5NDgy";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                $order_id .
                number_format($amount, 2, '.', '') .
                $currency .
                strtoupper(md5($merchant_secret))
            )
        );

        $array["id"] = $order_id;
        $array["item"] = $items;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["city"] = $city;
        $array["size"] = $usize;
        $array["umail"] = $umail;
        $array["mid"] = $merchant_id;
        $array["msecret"] = $merchant_secret;
        $array["currency"] = $currency;
        $array["hash"] = $hash;
        $array["orderstatus"]=$ostatus;

        echo json_encode($array);

    }else{
        echo("2");
    }

}else{
    echo("1");
}

?>