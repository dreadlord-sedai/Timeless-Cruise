<?php

session_start();
include "connection.php";

if(isset($_POST["avc"])){

    $adminVcode = $_POST["avc"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `verification_code`='".$adminVcode."'");
    $admin_num = $admin_rs->num_rows;

    if($admin_num == 1 ){
        $admin_data = $admin_rs->fetch_assoc();
        $_SESSION["au"] = $admin_data;
        echo ("success");
    }else{
        echo("Invalid Verification Code");
    }

}else{
    echo ("Please Insert Verification Code");
}

?>