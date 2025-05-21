<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile | Online Fashion Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="resources/logo design/fashin_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="AT1">

    <?php
    include "connection.php";

    session_start();
    if (isset($_SESSION["u"])) {

        $email = $_SESSION["u"]["email"];

        $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON
        user.gender_gender_id=gender.gender_id WHERE `email`='" . $email . "'");

        $address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON
        user_has_address.city_city_id=city.city_id INNER JOIN `district` ON
        city.district_district_id=district.district_id INNER JOIN `province` ON
        district.province_province_id=province.province_id WHERE `user_email`='" . $email . "'");

        $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

        $details_data = $details_rs->fetch_assoc();
        $address_data = $address_rs->fetch_assoc();
        $image_data = $image_rs->fetch_assoc();

    ?>
        <div class="mt-4" style="margin-left: 20px;">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-bold"><a href="index.php">Home</a></li>
                </ol>
            </nav>
        </div>


        <div class="container light-style flex-grow-1 container-p-y">
            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">
                    <div class="col-md-3 pt-0">
                        <div class="list-group list-group-flush account-settings-links">
                            <a class="list-group-item list-group-item-action active" data-toggle="list"
                                href="#account-general">General</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="#account-change-password">User Information</a>
                            <a class="list-group-item list-group-item-action" data-toggle="list"
                                href="#account-info">Location Information</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="account-general">

                                <!--Image Upload-->

                                <div class="card-body media align-items-center">

                                    <?php

                                    if (empty($image_data["img_path"])) {
                                    ?>
                                        <img src="resources/profile image/profile picture.jpg" class="d-block ui-w-80" id="image">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="<?php echo $image_data["img_path"]; ?>" class="d-block ui-w-80" id="image">
                                    <?php
                                    }

                                    ?>


                                    <div class="media-body ml-4">
                                        <label class="btn btn-outline-primary" onclick="changeProfileImage();">
                                            Upload new photo
                                            <input type="file" class="account-settings-fileinput" id="profileimage">
                                        </label> &nbsp;
                                        <div class="text-dark small mt-1">Allowed JPG, SVG or PNG.</div>
                                    </div>
                                </div>

                                <!--User details-->

                                <hr class="border-light m-0">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <input id="fname" type="text" class="form-control mb-1" value="<?php echo $details_data["fname"]; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Last Name</label>
                                        <input id="lname" type="text" class="form-control" value="<?php echo $details_data["lname"]; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="text" class="form-control mb-1" readonly value="<?php echo $email ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Registered Date</label>
                                        <input type="text" class="form-control" readonly value="<?php echo $details_data["registered_date"] ?>">
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="account-change-password">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Postal code</label>
                                        <?php
                                        if (empty($address_data["postal_code"])) {
                                        ?>
                                            <input id="pcode" type="text" class="form-control" placeholder="Type Your Postal Code In Area">
                                        <?php
                                        } else {
                                        ?>
                                            <input id="pcode" type="text" class="form-control" value="<?php echo $address_data["postal_code"] ?>">
                                        <?php
                                        }

                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Birthday</label>
                                        <?php
                                        if (empty($details_data["date_of_birth"])) {
                                        ?>
                                            <input id="bcode" type="text" class="form-control" placeholder="Type Your Birth Day : 2024-10-12">
                                        <?php
                                        } else {
                                        ?>
                                            <input id="bcode" type="text" class="form-control" value="<?php echo $details_data["date_of_birth"] ?>">
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <?php
                                    $gender_rs = Database::search("SELECT * FROM `gender`");
                                    ?>

                                    <div class="form-group">
                                        <label class="form-label">Gender</label>
                                        <select class="custom-select" id="gender">
                                            <?php
                                            for ($x = 0; $x < $gender_rs->num_rows; $x++) {
                                                $gender_data = $gender_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $gender_data["gender_id"]; ?>"
                                                    <?php
                                                    if (!empty($details_data["gender_id"])) {
                                                        if ($gender_data["gender_id"] == $details_data["gender_id"]) {
                                                    ?>selected<?php
                                                            }
                                                        }
                                                                ?>>
                                                    <?php echo $gender_data["gender_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input id="mobileN1" type="text" class="form-control" value="<?php echo $details_data["mobile"]; ?>">
                                    </div>
                                    <div class="alert alert-warning mt-3">
                                        You can change Your current Password by clicking this link<br>
                                        <a href="forgotpw1.php">Forgot Password</a>
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="account-info">
                                <hr class="border-light m-0">
                                <div class="card-body pb-2">
                                    <h6 class="mb-4">User Address</h6>
                                    <div class="form-group">
                                        <label class="form-label">Address</label>

                                        <?php
                                        if (empty($address_data["address"])) {
                                        ?>
                                            <textarea id="address" class="form-control" rows="3" placeholder="Type Your Address."></textarea>
                                        <?php
                                        } else {
                                        ?>
                                            <textarea id="address" class="form-control" rows="3">
                                                <?php echo $address_data["address"] ?>
                                            </textarea>
                                        <?php
                                        }
                                        ?>
                                    </div>


                                    <?php

                                    $province_rs = Database::search("SELECT * FROM `province`");
                                    $district_rs = Database::search("SELECT * FROM `district`");
                                    $city_rs = Database::search("SELECT * FROM `city`");

                                    ?>

                                    <div class="form-group">
                                        <label class="form-label">Province</label>
                                        <select class="custom-select" onchange="selectDistrict();" id="province">
                                            <option value="0">Select Province</option>
                                            <?php

                                            for ($x = 0; $x < $province_rs->num_rows; $x++) {
                                                $province_data = $province_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $province_data["province_id"]; ?>"
                                                    <?php if (!empty($address_data["province_id"])) {
                                                        if ($province_data["province_id"] == $address_data["province_id"]) {
                                                    ?>selected<?php
                                                            }
                                                        } ?>>
                                                    <?php echo $province_data["province_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">District</label>
                                        <select class="custom-select" id="district">
                                            <option selected>Select District</option>
                                            <?php

                                            for ($x = 0; $x < $district_rs->num_rows; $x++) {
                                                $district_data = $district_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $district_data["district_id"]; ?>"
                                                    <?php
                                                    if (!empty($address_data["district_id"])) {
                                                        if ($district_data["district_id"] == $address_data["district_id"]) {
                                                    ?>selected<?php
                                                            }
                                                        } ?>>
                                                    <?php echo $district_data["district_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">City</label>
                                        <select class="custom-select" id="city">
                                            <option value="0">Select City</option>
                                            <?php

                                            for ($x = 0; $x < $city_rs->num_rows; $x++) {
                                                $city_data = $city_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $city_data["city_id"]; ?>"
                                                    <?php
                                                    if (!empty($address_data["city_id"])) {
                                                        if ($city_data["city_id"] == $address_data["city_id"]) {
                                                    ?>selected<?php
                                                            }
                                                        } ?>>
                                                    <?php echo $city_data["city_name"]; ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right mt-1">
                <button type="button" class="btn btn-primary" onclick="updateProfile(); Acbutton();">Save changes</button>
            </div>
        </div>



    <?php
    }

    ?>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>