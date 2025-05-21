<?php
session_start();
include "connection.php";

$utitle = $_POST["t"];
$utype = $_POST["ut"];
$qty = $_POST["uq"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["d"];
$id = $_POST["pid"];

//! Update Product details
Database::iud("UPDATE `product` SET `product_title`='" . $utitle . "',`product_qty`='" . $qty . "',
`delevery_fee_colombo`='" . $dwc . "',`delevery_fee_other`='" . $doc . "',`product_desciption`='" . $desc . "'
WHERE `product_id`='" . $id . "'");

$length = sizeof($_FILES);

if ($length <= 3 && $length > 0) {
    $allowed_img_extentions = array("image/jpeg", "image/png", "image/svg+xml");

    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id`='".$id."'"); //!check Image
    $img_num = $img_rs->num_rows;

    for($a = 0; $a < $img_num;$a++){
        $img_data = $img_rs->fetch_assoc();

        unlink($img_data["p_img_path"]);
        Database::iud("DELETE FROM `product_img` WHERE `product_product_id`='" . $id . "'"); //! Delete Img In Database
    }

    for ($x = 0; $x < $length; $x++) {
        if (isset($_FILES["image" . $x])) {
            $image_file = $_FILES["image" . $x];

            $file_extention = $image_file["type"];

            if (in_array($file_extention, $allowed_img_extentions)) {

                $new_image_extention;

                if ($file_extention == "image/jpeg") {
                    $new_image_extention = ".jpeg";
                } else if ($file_extention == "image/png") {
                    $new_image_extention = ".png";
                } else if ($file_extention == "image/svg+xml") {
                    $new_image_extention = ".svg";
                }

                $file_name = "resources//product_img//" . $utitle . $x . uniqid() . $new_image_extention;
                move_uploaded_file($image_file["tmp_name"], $file_name);

                Database::iud("INSERT INTO `product_img`(`p_img_path`,`product_product_id`) 
                     VALUES ('" . $file_name . "','" . $id . "')");
            } else {
                echo ("Invalid image type");
            }
        }
    }
} else {
    echo ("Invalid Image Count.");
}
echo ("Product Updated");

?>