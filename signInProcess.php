<?php
session_start();
include "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];
$rememberMe = $_POST["r"];

if (empty($email)) {
    echo ("Please enter your Email Adress.");
} else if (strlen($email) > 100) {
    echo ("Email Address must contain Lower Than 100 Characters.");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address.");
} else if (empty($password)) {
    echo ("Please Enter Your Password.");
} else if (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Password must contain between 5 to 20 Characters.");
} else {


    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "' AND `password` = '" . $password . "'");
    $num = $rs->num_rows;

    if ($num == 1) {

        echo ("success");
        $data = $rs->fetch_assoc();
        $_SESSION["u"] = $data;

        if ($rememberMe == "true") {
            setcookie("email", $email, time() + (60 * 60 * 24 * 365));
            setcookie("password", $password, time() + (60 * 60 * 24 * 365));
        }
    } else {
        echo ("Invalid Email Address or Password.");
    }
}

?>