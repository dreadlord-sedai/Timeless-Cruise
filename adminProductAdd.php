<?php
session_start();

if (isset($_SESSION["au"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Product Adding | Online Fashion Store</title>

        <!-- Boxicons icon-->
        <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="css/adminPanel.css">
        <link rel="icon" href="resources/logo design/fashin_logo.png">
        <link rel="stylesheet" href="css/bootstrap.css">

        <style>
            #sidebar a {
                text-decoration: none;
            }
        </style>
    </head>

    <body style="background-color: #F9F9F9;">

        <?php
        include "connection.php";
        ?>
        <!-- sidebar -->
        <section id="sidebar" style="background-color:#ADBBDA;">
            <a href="dashboard.php" class="brand">
                <i class='bx bxs-cart-add'></i>
                <span class="text">Fashion_Store </span>
            </a>
            <div style="margin-left: -33px;">
                <ul class="side-menu top">
                    <li>
                        <a href="dashboard.php">
                            <i class='bx bxs-dashboard'></i>
                            <span class="text">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="adminProduct.php">
                            <i class='bx bxl-product-hunt'></i>
                            <span class="text">Products</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="adminProductAdd.php">
                            <i class='bx bxs-cart-add'></i>
                            <span class="text">Product Adding</span>
                        </a>
                    </li>
                    <li>
                        <a href="orderInformation.php">
                            <i class='bx bxs-bell'></i>
                            <span class="text">Order Information</span>
                        </a>
                    </li>
                    <li>
                        <a href="selling.php">
                            <i class='bx bxs-bar-chart-square'></i>
                            <span class="text">Selling History</span>
                        </a>
                    </li>

                </ul>

                <ul class="side-menu">
                    <li>
                        <a class="logout" style="cursor: pointer;">
                            <i class='bx bxs-log-out' onclick="adminsignout();"></i>
                            <span class="text" onclick="adminsignout();">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </section>



        <!-- content -->
        <section id="content">
            <!-- navbar -->
            <nav>
                <i class='bx bx-menu'></i>
                <a href="#" class="nav-link">Product Adding</a>

                <a href="#" class="notification">
                    <i class='bx bxs-bell'></i>
                    <span class="num">8</span>
                </a>

                <a href="admindetails.php" class="profile">
                    <img src="resources/profile image/profile picture.jpg">
                </a>
            </nav>

            <div class="container-fluid">
                <div class="row gy-3">
                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 text-center">
                                <h2 class="h2 text-primary fw-bold">Product Add</h2>
                            </div>

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
                                                <select class="form-select text-center" id="p_category">
                                                    <option value="0">Select Product Category</option>
                                                    <?php

                                                    $Category_rs = Database::search("SELECT * FROM `category`");
                                                    $Category_num = $Category_rs->num_rows;

                                                    for ($x = 0; $x < $Category_num; $x++) {
                                                        $Category_data = $Category_rs->fetch_assoc();

                                                    ?>
                                                        <option value="<?php echo $Category_data["cat_id"];  ?> ">
                                                            <?php echo $Category_data["cat_name"]; ?>
                                                        </option>

                                                    <?php

                                                    }
                                                    ?>
                                                </select>
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
                                                <select class="form-select text-center" id="p_brand">
                                                    <option value="0">Select Product Brand</option>
                                                    <?php


                                                    $brand_rs = Database::search("SELECT * FROM `brand`");
                                                    $brand_num = $brand_rs->num_rows;

                                                    for ($x = 0; $x < $brand_num; $x++) {
                                                        $brand_data = $brand_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $brand_data["brand_id"]; ?>">
                                                            <?php echo $brand_data["brand_name"]; ?>
                                                        </option>

                                                    <?php
                                                    }


                                                    ?>
                                                </select>
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
                                                <select class="form-select text-center" id="p_model">
                                                    <option value="0">Select Product Model</option>
                                                    <?php

                                                    $model_rs = Database::search("SELECT * FROM `model`");
                                                    $model_num = $model_rs->num_rows;

                                                    for ($x = 0; $x < $model_num; $x++) {
                                                        $model_data = $model_rs->fetch_assoc();

                                                    ?>
                                                        <option value="<?php echo $model_data["model_id"];  ?> ">
                                                            <?php echo $model_data["model_name"]; ?>
                                                        </option>

                                                    <?php

                                                    }
                                                    ?>
                                                </select>
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
                                                <input type="text" class="form-control" id="p_title" />
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
                                                            Product Colour
                                                        </label>
                                                    </div>
                                                    <div class="col-12">
                                                        <select class="form-select text-center" id="p_color">
                                                            <option value="0">Select Product Colour</option>
                                                            <?php


                                                            $brand_rs = Database::search("SELECT * FROM `color`");
                                                            $brand_num = $brand_rs->num_rows;

                                                            for ($x = 0; $x < $brand_num; $x++) {
                                                                $brand_data = $brand_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $brand_data["clr_id"]; ?>">
                                                                    <?php echo $brand_data["clr_name"]; ?>
                                                                </option>

                                                            <?php
                                                            }


                                                            ?>
                                                        </select>
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
                                                        <input type="number" class="form-control" min="0" value="0" id="p_qty" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">
                                                            Product Type
                                                        </label>
                                                    </div>
                                                    <div class="col-12">
                                                        <select class="form-select text-center" id="p_type">
                                                            <option value="0">Select Product Type</option>
                                                            <?php


                                                            $brand_rs = Database::search("SELECT * FROM `product_type`");
                                                            $brand_num = $brand_rs->num_rows;

                                                            for ($x = 0; $x < $brand_num; $x++) {
                                                                $brand_data = $brand_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $brand_data["p_type_id"]; ?>">
                                                                    <?php echo $brand_data["type_name"]; ?>
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

                                    <div class="col-12">
                                        <hr class="border-primary" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">
                                                            Cost Per Item
                                                        </label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" id="p_cost" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
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
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">
                                                    Delivery Cost
                                                </label>
                                            </div>
                                            <div class="col-12 col-lg-6 border-end border-primary">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">
                                                            Delivery cost Within Colombo
                                                        </label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" id="p_d_c" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">
                                                            Delivery cost out of Colombo
                                                        </label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" id="p_d_o" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
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
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">
                                                    Product Description
                                                </label>
                                            </div>
                                            <div class="col-12">
                                                <textarea cols="30" rows="10" class="form-control" id="p_d"></textarea>
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
                                                    Add Product Images
                                                </label>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="img/empty logo.png" class="img-thumbnail"
                                                            style="width: 250px;" id="p0" />
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="img/empty logo.png" class="img-thumbnail"
                                                            style="width: 250px;" id="p1" />
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="img/empty logo.png" class="img-thumbnail"
                                                            style="width: 250px;" id="p2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                                <input type="file" class="d-none" id="imageuploader" multiple />
                                                <label for="imageuploader" class="col-12 btn btn-outline-primary text-black" onclick="changeProductImage();">
                                                    Upload Images
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-primary" />
                                    </div>

                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                        <button class="btn btn-outline-secondary text-black" onclick="addProduct();">
                                            Adding Product
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>


        <script src="js/script.js"></script>
        <script src="js/adminscript.js"></script>
    </body>

    </html>
<?php
} else {
    header("Location:adminsign.php");
}
?>