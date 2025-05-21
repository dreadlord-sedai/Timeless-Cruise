<?php
session_start();
include "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `brand_has_model` ON
    product.brand_has_model_model_has_brand_id=brand_has_model.model_has_brand_id INNER JOIN 
    `brand` ON brand_has_model.brand_brand_id=brand.brand_id INNER JOIN `model` ON
    brand_has_model.model_model_id=model.model_id INNER JOIN `category` ON
    product.category_cat_id=category.cat_id INNER JOIN `admin` ON 
    product.admin_admin_email=admin.admin_email WHERE `product_id`='" . $pid . "'");

    if ($product_rs->num_rows == 1) {
        $product_data = $product_rs->fetch_assoc();
?>
        <!DOCTYPE html>

        <html>

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>Onine Fashion Store | <?php echo $product_data["cat_name"] ?></title>

            <link rel="stylesheet" href="css/bootstrap.css" />
            <link rel="stylesheet" href="css/style.css" />
            <link rel="icon" href="resources/logo design/fashin_logo.png" />
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
                rel="stylesheet">
            <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

            <style>
                body {
                    background-color: #fff;
                }

                .card {
                    border: none;
                }

                .product {
                    background-color: #eee;
                }

                .brand {
                    font-size: 13px;
                }

                .act-price {
                    color: #555;
                    font-weight: 700;
                }

                .dis-price {
                    text-decoration: line-through;
                }

                .about {
                    font-size: 14px;
                }

                .color {
                    margin-bottom: 10px;
                }

                label.radio {
                    cursor: pointer;
                }

                label.radio input {
                    position: absolute;
                    top: 0;
                    left: 0;
                    visibility: hidden;
                    pointer-events: none;
                }

                label.radio span {
                    padding: 2px 9px;
                    border: 2px solid #ADBBDA;
                    display: inline-block;
                    color: #ADBBDA;
                    border-radius: 3px;
                    text-transform: uppercase;
                }

                label.radio input:checked+span {
                    border-color: #ADBBDA;
                    background-color: #ADBBDA;
                    color: #fff;
                }

                .btn-danger {
                    background-color: #ADBBDA !important;
                    border-color: #ADBBDA !important
                }

                .btn-danger:hover {
                    background-color: #eee !important;
                    border-color: #fff !important;
                }

                .btn-danger:focus {
                    box-shadow: none;
                }

                .sP1 {
                    display: flex;
                    flex-basis: 50%;
                }
            </style>

        </head>

        <body>

            <!---single product details-->

            <div class="small-container single-product">
                <div class="sP1 row">
                    <div class="mt-4" style="margin-left: 20px;">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item fw-bold" style="text-decoration: none;">
                                    <a href="index.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Single Product View</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="col-md-6">
                        <div class="images p-3 row col-12">
                            <div class="text-center p-4">
                                <img id="main-image" src="img/Single Product View.jpg" width="250" />
                            </div>

                            <?php
                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id`='" . $pid . "'");
                            $img_num = $img_rs->num_rows;
                            $img = array();

                            if ($img_num != 0) {
                                for ($x = 0; $x < $img_num; $x++) {
                                    $img_data = $img_rs->fetch_assoc();
                                    $img[$x] = $img_data["p_img_path"];
                            ?>
                                    <div class="thumbnail col-4">
                                        <img onclick="change_image(this)" src="<?php echo $img[$x]; ?>" width="70">
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div class="text-center fw-bold">
                                    <h4>No Product Image</h4>
                                </div>
                            <?php
                            }
                            ?>


                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="product p-4">
                            <div class="mt-4 mb-3">
                                <span class="text-uppercase text-muted brand">
                                    <?php echo $product_data["brand_name"] ?>
                                </span>

                                <h5 class="text-uppercase">
                                    <?php echo $product_data["product_title"]; ?>
                                </h5>

                                <?php

                                $price = $product_data["product_price"];
                                $add_price = ($price / 100) * 10;
                                $new_price = $price + $add_price;

                                ?>

                                <div class="price d-flex flex-row align-items-center">
                                    <span class="act-price">
                                        Rs. <?php echo $price; ?> .00
                                    </span>
                                    <div class="ml-2 p-1">
                                        <small class="dis-price">
                                            Rs. <?php echo $new_price; ?> .00
                                        </small>
                                        <span>
                                            10% OFF
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <p class="about text-capitalize">
                                <?php echo $product_data["product_desciption"]; ?>
                            </p>

                            <div class="col-12 text-center">
                                <span class="fw-bold text-secondary">
                                    Product Size
                                    <br>
                                    <?php echo $product_data["model_name"]; ?>
                                </span>
                            </div>

                            <div class="col-12 text-center mt-2">
                                <span class="fw-bold text-secondary">Quantity</span><br>
                                <input type="number" onkeyup="checkQty(<?php echo $product_data['product_qty']; ?>);"
                                    pattern="[0-9]" id="qty_input" class="text-center">
                            </div>

                            <div class="mt-3">
                                <a style="display: flex; align-items: center; justify-content: center;"
                                    onclick="addCart('<?php echo $product_data['product_id'] ?>','<?php echo $product_data['product_qty']; ?>')">
                                    <i class='bx bx-cart-add bx-md bx-tada-hover'></i>
                                </a>
                            </div>

                            <div class="cart mt-4 align-items-center rounded col-12">
                                <button type="submit" id="payhere-payment" class="btn btn-danger text-uppercase mr-2 px-4 col-12"
                                    onclick="payNow(<?php echo $pid; ?>);">
                                    Buy
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <hr class="border-primary" />
            </div>

            <!----proof---->
            <?php
            $proof_rs = Database::search("SELECT * FROM `feedback` WHERE `feedback`.`product_product_id`='" . $pid . "' LIMIT 3");
            $proof_num = $proof_rs->num_rows;
            $proof_data = $proof_rs->fetch_assoc();

            if ($proof_num > 0) {
            ?>
                <div class="proof">
                    <div class="small-container">
                        <h2>All Review</h2>
                        <div class="row">
                            <div class="proof1 col-3">
                                <i class="las la-quote-left"></i>
                                <p><?php echo $proof_data["feedback_msg"]; ?></p>
                                <i class="las la-quote-right"></i>
                                <br>
                                <?php
                                $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `profile_img`.`user_email`='" . $proof_data['customer_email'] . "'");
                                $img_num = $img_rs->num_rows;
                                $img_data = $img_rs->fetch_assoc();

                                if ($img_num > 0) {
                                ?>
                                    <a href="#">
                                        <img src="<?php echo $img_data["img_path"]; ?>">
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a href="#">
                                        <img src="resources/profile image/profile picture.jpg">
                                    </a>
                                <?php
                                }
                                ?>
                                <br>
                                <h3 class="mt-1">
                                    <?php echo $proof_data["customer_email"]; ?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="proof">
                    <div class="small-container">
                        <h2>All Review</h2>
                        <div class="row">
                            <div class="proof1 col-3">
                                <h3>No Review Here</h3>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>

            <div class="col-12">
                <hr class="border-primary" />
            </div>


            <!---title--->
            <div class="small-container">
                <h2 class="title">RELATED DESIGN </h2>
                <div class="row">
                    <?php
                    $related_rs = Database::search("SELECT * FROM `product` WHERE `brand_has_model_model_has_brand_id`
                    ='" . $product_data["brand_has_model_model_has_brand_id"] . " LIMIT 3'");

                    for ($x = 0; $x < $related_rs->num_rows; $x++) {
                        $related_data = $related_rs->fetch_assoc();
                    ?>

                        <!--design-->
                        <div class="lb1 col-3">

                            <?php
                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id` ='" . $related_data["product_id"] . "'");
                            $img_num = $img_rs->num_rows;
                            $img_data = $img_rs->fetch_assoc();

                            if ($img_num > 0) {
                            ?>
                                <a href="singleProduct.php?id=<?php echo $related_data["product_id"]; ?>">
                                    <img src="<?php echo $img_data["p_img_path"]; ?>">
                                </a>
                            <?php
                            } else {
                            ?>
                                <a href="singleProduct.php?id=<?php echo $related_data["product_id"]; ?>">
                                    <img src="resources/logo design/No Product Image.jpg">
                                </a>
                            <?php
                            }
                            ?>
                            <span class="badge rounded-pill text-bg-warning mt-1" style="align-items: center; display: flex; justify-content: center;">
                                RELATED
                            </span>
                            <h4 class="text-center"><?php echo $related_data["product_title"]; ?></h4>
                            <span style="display: flex; justify-content: center; align-items: center; cursor: pointer;">
                                <i class='bx bxs-heart bx-border-circle bx-sm bx-flashing text-danger'></i>
                            </span>
                            <p class="text-center mt-1">Rs. <?php echo $related_data["product_price"]; ?> .00</p>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div class="col-12">
                <hr class="border-primary" />
            </div>

            <!---brands--->

            <div class="brands">
                <div class="small-container">
                    <div class="row">
                        <div class="b1 col-2">
                            <a href="#"><img src="resources/adidas-logo-svgrepo-com.svg"></a>
                        </div>
                        <div class="b1 col-2">
                            <a href="#"><img src="resources/nike.svg"></a>
                        </div>
                        <div class="b1 col-2">
                            <a href="#"><img src="resources/logo design/giggle-logo.png"></a>
                        </div>
                        <div class="b1 col-2">
                            <a href="#"><img src="resources/puma-logo.svg"></a>
                        </div>
                        <div class="b1 col-2">
                            <a href="#"><img src="resources/logo design/Logo-Crocodile.png"></a>
                        </div>
                        <div class="b1 col-2">
                            <a href="#"><img src="resources/polo-members.svg"></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <hr class="border-primary" />
            </div>

            <!--footer-->

            <?php
            include "footer.php";
            ?>


            <!---js for product gallery--->

            <script>
                function change_image(image) {

                    var container = document.getElementById("main-image");

                    container.src = image.src;
                }
                document.addEventListener("DOMContentLoaded", function(event) {});
            </script>

            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
            <script src="js/script.js"></script>
            <script src="js/bootstrap.bundle.js"></script>
        </body>

        </html>
<?php
    } else {
        echo ("Something Went Wrong, Try again Later.");
    }
} else {
    echo ("Please Select a Product First.");
}
?>