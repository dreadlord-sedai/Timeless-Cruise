<?php

include "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];

//! validation

if (empty($fname)) {
    echo ("Please Enter Your First Name.");
} else if (strlen($fname) > 50) {
    echo ("First Name must contain Lower Than 50 Characters.");
} else if (empty($lname)) {
    echo ("Please Enter Your Last Name.");
} else if (strlen($lname) > 50) {
    echo ("Last Name must contain Lower Than 50 Characters.");
} else if (empty($email)) {
    echo ("Please Enter Your Email Address.");
} else if (strlen($email) > 100) {
    echo ("Email Address must contain Lower Than 100 Characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalied Your Email Address.");
} else if (empty($password)) {
    echo ("Please Enter Your Password.");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must contain between 5 to 20 Characters.");
} elseif (!preg_match("#[0-9]+#", $password)) {
    echo ("Your Password Must Contain At Least 1 Number!");
} elseif (!preg_match("#[A-Z]+#", $password)) {
    echo ("Your Password Must Contain At Least 1 Capital Letter!");
} elseif (!preg_match("#[a-z]+#", $password)) {
    echo ("Your Password Must Contain At Least 1 Lowercase Letter!");
} else if (empty($mobile)) {
    echo ("Please Enter Your Mobile Number.");
} else if (strlen($mobile) != 10) {
    echo ("Mobile Number must contain 10 characters.");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8,9]{1}[0-9]{7}/", $mobile)) {
    echo ("Invalied Mobile Number.");
} elseif (empty($gender)) {
    echo ("Please Select Gender");
} else {

    $rs = Database::search("SELECT * FROM `user` WHERE `email` ='" . $email . "' OR `mobile` = '" . $mobile . "'");
    $num = $rs->num_rows;

    if ($num > 0) {
        echo ("User with the same Email Address or Mobile Number already exists.");
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user`(`fname`,`lname`,`email`,`password`,`registered_date`,`mobile`,
        `gender_gender_id`) VALUES('" . $fname . "','" . $lname . "','" . $email . "','" . $password . "',
        '" . $date . "','" . $mobile . "','".$gender."')");

        echo ("success");
    }
}

?>