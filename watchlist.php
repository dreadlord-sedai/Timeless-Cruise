<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Watchlist | Online Fashion Store </title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="resources/logo design/fashin_logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        .emptyView {
            height: 400px;
            background-image: url("resources/logo\ design/watchlist.png");
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>

    <?php
    include "header.php";
    ?>

    <div class="small-container">
        <div class="mt-5" style="margin-left: 20px;">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-bold"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">watchlist</li>
                </ol>
            </nav>
        </div>

        <div class="n2 text-bold m-3 text-center">
            <h3>Watchlist</h3>
        </div>

        <?php
        include "connection.php";

        if (isset($_SESSION["u"])) {
            $watchlist_rs = Database::search("SELECT * FROM `watchlist` INNER JOIN `product` ON 
            watchlist.product_product_id=product.product_id INNER JOIN `user` ON watchlist.user_email=user.email
            WHERE watchlist.user_email='" . $_SESSION["u"]["email"] . "'");

            $watchlist_num = $watchlist_rs->num_rows;
        ?>
            <!---watchlist -->
            <div class="card mb-3 mx-0 col-12">
                <div class="row g-0">
                    <!--picture-->
                    <?php
                    if ($watchlist_num == 0) {
                    ?>
                        <!--empty -->
                        <div class="col-12 emptyView"></div>
                        <div class="col-12 text-center">
                            <label class="form-label fs-1 fw-bold">
                                No Items In Watchlist Yet.
                            </label>
                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                <a href="index.php" class="btn btn-primary fs-4 fw-bold">Shopping Now</a>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <!--Product Watchlist design-->
                        <?php
                        for ($x = 0; $x < $watchlist_num; $x++) {
                            $watchlist_data = $watchlist_rs->fetch_assoc();
                            $list_id = $watchlist_data["w_id"];
                        ?>
                            <div class="col-md-5 ">
                                <div class="card-body">
                                    <h4 class="card-title text-center">
                                        <?php echo $watchlist_data["product_title"]; ?>
                                    </h4>
                                    <br>
                                    <div class="text-center">
                                        <span class="fw-bold text-danger fs-5">
                                            Price: Rs. <?php echo $watchlist_data["product_price"]; ?> .00
                                        </span>
                                        <br>
                                        <span class="fw-bold text-warning fs-5">
                                            Quantity: <?php echo $watchlist_data["product_qty"]; ?> Items available
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id`
                            ='" . $watchlist_data['product_product_id'] . "'");

                            $img_num = $img_rs->num_rows;
                            $img_data = $img_rs->fetch_assoc();

                            if ($img_num > 0) {
                            ?>
                                <div class="col-md-4 p-1">
                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                        data-bs-content="<?php echo $watchlist_data["product_desciption"]; ?>" title="Online Fashion Store">
                                        <img src="<?php echo $img_data["p_img_path"]; ?>" class="img-fluid rounded" style="max-width: 200px;">
                                    </span>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col-md-4">
                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                        data-bs-content="<?php echo $watchlist_data["product_desciption"]; ?>" title="Online Fashion Store">
                                        <img src="img/No item.png" class="img-fluid rounded-start" style="max-width: 200px;">
                                    </span>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="col-md-3">
                                <div class="card-body d-grid">
                                    <?php
                                    $buyNow_rs = Database::search("SELECT * FROM `product` WHERE `status_status_id`='1'
                                    AND `product_id`='" . $watchlist_data['product_product_id'] . "'");

                                    $buyNow_num = $buyNow_rs->num_rows;
                                    $buyNow_data = $buyNow_rs->fetch_assoc();
                                    ?>
                                    <a href="singleProduct.php?id=<?php echo $buyNow_data["product_id"]; ?>" class="btn btn-outline-success mb-2">
                                        Buy Now
                                    </a>
                                    <a class="btn btn-outline-danger mt-2" onclick="removeWachlist(<?php echo $list_id; ?>);">
                                        Remove
                                    </a>
                                </div>
                            </div>

                            <div class="col-12">
                                <hr class="border-secondary" />
                            </div>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                </div>
            </div>
    </div>
<?php
        }
?>


<div class="small-container text-center">
    <div class="row col-12" style="justify-content: space-around;">
        <a href="purchasedHistory.php" class="btn btn-danger col-5 fw-bold">
            Purchased History
        </a>
        <a href="cart.php" class="btn btn-success col-5 fw-bold" style="color: #fff;">
            Cart
        </a>
    </div>
</div>

<div class="small-container mt-2">
    <h2 class="title">POPULAR DESIGN</h2>
    <div class="row">

        <?php
        $popular_rs = Database::search("SELECT * FROM `product` WHERE `product_type_p_type_id`='1' 
            AND `status_status_id`='1' ORDER BY `p_date_time_add` DESC LIMIT 4 OFFSET 0");

        $popular_num = $popular_rs->num_rows;

        if ($popular_num > 0) {
            for ($z = 0; $z < $popular_num; $z++) {
                $popular_data = $popular_rs->fetch_assoc();
        ?>

                <!--design-->
                <div class="lb1 col-3">

                    <?php
                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id` ='" . $popular_data["product_id"] . "'");
                    $img_num = $img_rs->num_rows;
                    $img_data = $img_rs->fetch_assoc();

                    if ($img_num > 0) {
                    ?>
                        <a href="singleProduct.php?id=<?php echo $popular_data["product_id"]; ?>">
                            <img src="<?php echo $img_data["p_img_path"]; ?>">
                        </a>
                    <?php
                    } else {
                    ?>
                        <a href="singleProduct.php?id=<?php echo $popular_data["product_id"]; ?>">
                            <img src="resources/logo design/No Product Image.jpg">
                        </a>
                    <?php
                    }
                    ?>
                    <span class="badge rounded-pill text-bg-danger mt-1" style="align-items: center; display: flex; justify-content: center;">
                        POPULAR
                    </span>
                    <h4 class="text-center"><?php echo $popular_data["product_title"]; ?></h4>

                    <?php
                    if (isset($_SESSION["u"])) {
                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
                            `user_email`='" . $_SESSION["u"]["email"] . "' AND `product_product_id`='" . $popular_data["product_id"] . "'");
                        $watchlist_num = $watchlist_rs->num_rows;

                        if ($watchlist_num == 1) {
                    ?>
                            <span style="display: flex; justify-content: center; align-items: center; cursor: pointer;"
                                onclick="addToWatchlist(<?php echo $popular_data['product_id']; ?>);">
                                <i class='bx bxs-heart bx-border-circle bx-sm bx-flashing text-danger'
                                    id="heart<?php echo $popular_data['product_id']; ?>"></i>
                            </span>
                        <?php
                        } else {
                        ?>
                            <span style="display: flex; justify-content: center; align-items: center; cursor: pointer;"
                                onclick="addToWatchlist(<?php echo $popular_data['product_id']; ?>);">
                                <i class='bx bx-cart-add bx-md bx-flashing text-info'
                                    id="heart<?php echo $popular_data['product_id']; ?>"></i>
                            </span>
                    <?php
                        }
                    }
                    ?>
                    <p class="text-center mt-1">Rs. <?php echo $popular_data["product_price"]; ?> .00</p>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="col-12 text-center">
                <p class="h3 fw-bold text-danger">No Popular Items To Preview Yet !</p>
                <img src="resources/logo design/No Product Image.jpg" style="width: 100px;"
                    class="img-fluid" alt="No Item.....">
            </div>
        <?php
        }
        ?>
    </div>
</div>

<!----footer---->
<?php
include "footer.php";
?>

<script src="js/script.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })
</script>
</body>

</html>