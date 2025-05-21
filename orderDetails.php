<?php

session_start();
include "connection.php";

if (isset($_SESSION["au"])) {
    $did = $_GET["id"];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Order Details | Online Fashion Store</title>

        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="icon" href="resources/logo design/fashin_logo.png">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <style>
            .order a {
                text-decoration: none;
            }
        </style>
    </head>

    <body style="background-color: #F9F9F9;">

        <div class="mt-4 order" style="margin-left: 20px;">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item fw-bold">
                        <a href="orderInformation.php">Order Information</a>
                    </li>
                </ol>
            </nav>
        </div>


        <div class="container-fluid">
            <div class="row gy-3">
                <div class="col-12">
                    <div class="row">
                        <?php
                        $Dorder_rs = Database::search("SELECT * FROM `invoice` WHERE `product_product_id`='" . $did . "'");
                        $Dorder_num = $Dorder_rs->num_rows;

                        for ($i = 0; $i < $Dorder_num; $i++) {
                            $Dorder_data = $Dorder_rs->fetch_assoc();

                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $Dorder_data["user_email"] . "'");
                            $user_data = $user_rs->fetch_assoc();

                            $ua_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $Dorder_data["user_email"] . "'");
                            $ua_data = $ua_rs->fetch_assoc();

                            $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `brand_has_model` ON
                            product.brand_has_model_model_has_brand_id=brand_has_model.model_has_brand_id INNER JOIN 
                            `brand` ON brand_has_model.brand_brand_id=brand.brand_id INNER JOIN `model` ON
                            brand_has_model.model_model_id=model.model_id INNER JOIN `category` ON
                            product.category_cat_id=category.cat_id WHERE `product_id`='" . $Dorder_data["product_product_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();
                        }
                        ?>

                        <div class="col-12 mt-2">
                            <div class="row">
                                <div class="col-12 col-lg-4 border-end border-primary">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">
                                                Product Category
                                            </label>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" class="form-control" value="<?php echo $product_data["cat_name"]; ?>" disabled />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4 border-end border-primary">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">
                                                Product Brand
                                            </label>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" class="form-control" value="<?php echo $product_data["brand_name"]; ?>" disabled />
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">
                                                Product Model
                                            </label>
                                        </div>
                                        <div class="col-12">
                                            <input type="text" class="form-control" value="<?php echo $product_data["model_name"]; ?>" disabled/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-primary" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">
                                                Product Title
                                            </label>
                                        </div>
                                        <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                            <input type="text" class="form-control" value="<?php echo $product_data["product_title"]; ?>" disabled/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-primary" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-4 border-end border-primary">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">
                                                        User Email
                                                    </label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" class="form-control" value="<?php echo $ua_data["user_email"]; ?>" disabled/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4 border-end border-primary">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">
                                                        Product Quantity
                                                    </label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="number" class="form-control" min="0" value="<?php echo $product_data["product_qty"]; ?>" disabled />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">
                                                        Request Quantity
                                                    </label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" class="form-control" value="<?php echo $Dorder_data["order_qty"]; ?> " disabled/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-primary" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-lg-4 border-end border-primary">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">
                                                        Payment
                                                    </label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" class="form-control" value="Rs. <?php echo $Dorder_data["total"]; ?> .00" disabled />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4 border-end border-primary">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">
                                                        Payment Approval
                                                    </label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" class="form-control"
                                                        value="Yes" disabled />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">
                                                        Payment_Date and Time
                                                    </label>
                                                </div>
                                                <div class="col-12">
                                                    <input type="text" class="form-control"
                                                        value="<?php echo $Dorder_data["order_date"]; ?>" disabled />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-primary" />
                                </div>



                                <div class="col-12">
                                    <hr class="border-primary" />
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">
                                                Order Location
                                            </label>
                                        </div>
                                        <div class="col-12">
                                            <textarea cols="30" rows="5" class="form-control" disabled>
                                                <?php echo $ua_data["address"]; ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-primary" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/script.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("You Have to Buy Product First to Enter This Page ");
}
?>