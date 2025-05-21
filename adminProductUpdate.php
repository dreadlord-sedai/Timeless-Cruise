<?php
include "connection.php";
session_start();

if (isset($_SESSION["au"])) {
    $pid = $_GET["id"];

    $pUpdate_rs = Database::search("SELECT * FROM `product` INNER JOIN `category` ON product.category_cat_id
    =category.cat_id INNER JOIN `brand_has_model` ON product.brand_has_model_model_has_brand_id = brand_has_model
    .model_has_brand_id INNER JOIN `model` ON brand_has_model.model_model_id = model.model_id INNER JOIN
    `brand` ON brand_has_model.brand_brand_id=brand.brand_id INNER JOIN `product_type` ON product.product_type_p_type_id=
    product_type.p_type_id INNER JOIN `color` ON product.color_clr_id=color.clr_id WHERE `product_id`='" . $pid . "'");

    $pUpdate_data = $pUpdate_rs->fetch_assoc();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Product Updating | Online Fashion Store</title>

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
                        <a href="adminProduct.php">Home</a>
                    </li>
                </ol>
            </nav>
        </div>


        <div class="container-fluid">
            <div class="row gy-3">
                <div class="col-12">
                    <div class="row">

                        <div class="col-12 text-center">
                            <h2 class="h2 text-primary fw-bold">Product Update</h2>
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
                                            <select class="form-select text-center" disabled>
                                                <option>
                                                    <?php echo $pUpdate_data["cat_name"]; ?>
                                                </option>
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
                                            <select class="form-select text-center" disabled>
                                                <option>
                                                    <?php echo $pUpdate_data["brand_name"]; ?>
                                                </option>
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
                                            <select class="form-select text-center" disabled>
                                                <option>
                                                    <?php echo $pUpdate_data["model_name"]; ?>
                                                </option>
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
                                            <input type="text" class="form-control" id="u_title"
                                                value="<?php echo $pUpdate_data["product_title"]; ?>" />
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
                                                    <select class="form-select text-center" disabled>
                                                        <option>
                                                            <?php echo $pUpdate_data["clr_name"]; ?>
                                                        </option>
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
                                                    <input type="number" class="form-control" min="0" id="u_qty"
                                                        value="<?php echo $pUpdate_data["product_qty"]; ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" col-12 col-lg-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label fw-bold" style="font-size: 20px;">
                                                        Product Type
                                                    </label>
                                                </div>
                                                <div class="col-12">
                                                    <select class="form-select text-center" id="u_type" disabled>
                                                        <option value="0">
                                                            <?php echo $pUpdate_data["type_name"]; ?>
                                                        </option>
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
                                                        <input type="text" class="form-control"
                                                            value="<?php echo $pUpdate_data["product_price"]; ?>" disabled />
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
                                                        <input type="text" class="form-control" id="udc"
                                                            value="<?php echo $pUpdate_data["delevery_fee_colombo"]; ?>" />
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
                                                        <input type="text" class="form-control" id="udo"
                                                            value="<?php echo $pUpdate_data["delevery_fee_other"]; ?>" />
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
                                            <textarea cols="30" rows="10" class="form-control" id="ud">
                                                <?php echo $pUpdate_data["product_desciption"]; ?>"
                                            </textarea>
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
                                        <?php
                                        $img = array();

                                        $img[0] = "img/empty logo.png";
                                        $img[1] = "img/empty logo.png";
                                        $img[2] = "img/empty logo.png";

                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id`='" . $pid . "'");
                                        $img_num = $img_rs->num_rows;

                                        for ($x = 0; $x < $img_num; $x++) {
                                            $img_data = $img_rs->fetch_assoc();
                                            $img[$x] = $img_data["p_img_path"];
                                        }
                                        ?>
                                        <div class="offset-lg-3 col-12 col-lg-6">
                                            <div class="row">
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="<?php echo $img[0]; ?>" class="img-thumbnail"
                                                        style="width: 250px;" id="p0" />
                                                </div>
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="<?php echo $img[1]; ?>" class="img-thumbnail"
                                                        style="width: 250px;" id="p1" />
                                                </div>
                                                <div class="col-4 border border-primary rounded">
                                                    <img src="<?php echo $img[2]; ?>" class="img-thumbnail"
                                                        style="width: 250px;" id="p2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                                            <input type="file" class="d-none" id="imageuploader" multiple />
                                            <label for="imageuploader" class="col-12 btn btn-outline-primary text-black"
                                            onclick="changeProductImage();">
                                                Change Images
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <hr class="border-primary" />
                                </div>

                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                    <button class="btn btn-outline-secondary text-black"
                                        onclick="updateProduct('<?php echo $pUpdate_data['product_id']; ?>');">
                                        Update Product
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/script.js"></script>
        <script src="js/bootstrap.bundle.js"></script>
    </body>

    </html>
<?php
} else {
    echo ("Please Login To Your Account");
}
?>