<?php

session_start();
include "connection.php";

$email = $_SESSION["u"]["email"];

$fname = $_POST["f"];
$lname = $_POST["l"];
$pcode = $_POST["pc"];
$birth = $_POST["b"];
$gender = $_POST["g"];
$mobile = $_POST["m"];
$address = $_POST["add1"];
$city = $_POST["c"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $email . "'");

if ($user_rs->num_rows == 1) {
    //! Update
    Database::iud("UPDATE `user` SET `fname`='" . $fname . "', `lname`='" . $lname . "', `date_of_birth`='" . $birth . "',
    `gender_gender_id`='" . $gender . "', `mobile`='" . $mobile . "' WHERE `email`='" . $email . "'");

    //*Search
    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` ='" . $email . "'");

    if ($address_rs->num_rows == 1) {

        //? update
        Database::iud("UPDATE `user_has_address` SET `city_city_id`='" . $city . "', `address`='" . $address . "',
        `postal_code`='" . $pcode . "' WHERE `user_email`='" . $email . "'");
    } else {

        //? Insert
        Database::iud("INSERT `user_has_address` (`user_email`,`city_city_id`,`address`,`postal_code`)
        VALUES ('" . $email . "','" . $city . "','" . $address . "','" . $pcode . "')");
    }


    if (sizeof($_FILES) == 1) {
        //image upload
        $image = $_FILES["i"];
        $image_extention = $image["type"];

        $allowed_image_extensions = array("image/jpeg", "image/png", "image/svg+xml");

        if (in_array($image_extention, $allowed_image_extensions)) {

            $new_extension;

            if ($image_extention == "image/jpeg") {
                $new_extension = ".jpeg";
            } else if ($image_extention == "image/png") {
                $new_extension = ".png";
            } else if ($image_extention == "image/svg+xml") {
                $new_extension = ".svg";
            }

            $file_name = "resources//profiles//" . $fname . "_" . uniqid() . $new_extension;
            move_uploaded_file($image["tmp_name"], $file_name);

            $image_rs = Database::search("SELECT * FROM `profile_img` WHERE 
                `user_email` ='" . $email . "'");

            if ($image_rs->num_rows == 1) {

                //! Update
                Database::iud("UPDATE `profile_img` SET `img_path`='" . $file_name . "' WHERE `user_email`='" . $email . "'");
                echo ("Updated");
            } else {

                //! Insert
                Database::iud("INSERT INTO `profile_img`(`img_path`,`user_email`) VALUES ('" . $file_name . "','" . $email . "')");
                echo ("Saved");
            }
        }
    } else if (sizeof($_FILES) == 0) {
        echo ("You Have Not Selected Any Profile Image.");
    } else {
        echo ("You Can Upload Only 1 Profile Image."); 
    }
} else {
    echo ("Invalid User.");
}


?>