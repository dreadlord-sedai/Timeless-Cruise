<?php
include "connection.php";
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home | Online Fashion Store</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="resources/logo design/fashin_logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php
    include "header.php";
    ?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid header">

            <a class="navbar-brand" href="index.php">
                <img src="resources/logo design/fashin_logo.png" style="width: 50px;">
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Product</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="search.php">Search</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="userProfile.php">Account</a>
                    </li>
                </ul>

                <a href="cart.php"><img src="img/Cart icon.png" width="60px" height="60px"></a>

                <form class="d-flex" role="search">
                    <div class="input-group col-6">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">

                        <select class="form-select" style="max-width: 250px;" id="basic_search_select">
                            <option value="0">All Categories</option>
                            <?php

                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $category_data["cat_id"]; ?>">
                                    <?php echo $category_data["cat_name"]; ?>
                                <?php
                            }

                                ?>
                        </select>
                        <button class="btn btn-light col-2">
                            <i class='bx bxs-search bx-sm text-primary'></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </nav>


    <!--picture-->
    <div class="col-12 d-none d-lg-block mb-3">
        <div id="carouselExampleInterval" class="carousel slide offset-2 col-8" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="6000">
                    <a href="index.php"><img src="img/fashion_img1.jpg" class="d-block w-1000 img-thumbnail poster-img-1" style="width: 1000px; height: 500px;"></a>
                    <div class="carousel-caption d-none d-md-block poster-caption">
                        <h5 class="poster-title">Modern Fashion</h5>
                        <p class="poster-txt">Sri lanka</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--featured products-->
    <div class="small-container">
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
            <a href="popularProduct.php" class="btn btn-outline-dark col-12">More Information Click This !</a>
        </div>
    </div>

    <div class="col-12">
        <hr class="border-primary" />
    </div>

    <div class="small-container">
        <h2 class="title">LATEST DESIGN</h2>
        <div class="row">
            <?php
            $latest_rs = Database::search("SELECT * FROM `product` WHERE `product_type_p_type_id`='2' 
            AND `status_status_id`='1' ORDER BY `p_date_time_add` DESC LIMIT 8 OFFSET 0");

            $latest_num = $latest_rs->num_rows;

            if ($latest_num > 0) {
                for ($l = 0; $l < $latest_num; $l++) {
                    $latest_data = $latest_rs->fetch_assoc();
            ?>

                    <!--design-->
                    <div class="lb1 col-3">

                        <?php
                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id` ='" . $latest_data["product_id"] . "'");
                        $img_num = $img_rs->num_rows;
                        $img_data = $img_rs->fetch_assoc();

                        if ($img_num > 0) {
                        ?>
                            <a href="singleProduct.php?id=<?php echo $latest_data["product_id"]; ?>">
                                <img src="<?php echo $img_data["p_img_path"]; ?>">
                            </a>
                        <?php
                        } else {
                        ?>
                            <a href="singleProduct.php?id=<?php echo $latest_data["product_id"]; ?>">
                                <img src="resources/logo design/No Product Image.jpg">
                            </a>
                        <?php
                        }
                        ?>
                        <span class="badge rounded-pill text-bg-primary mt-1" style="align-items: center; display: flex; justify-content: center;">
                            LATEST
                        </span>
                        <h4 class="text-center"><?php echo $latest_data["product_title"]; ?></h4>

                        <?php
                        if (isset($_SESSION["u"])) {
                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
                            `user_email`='" . $_SESSION["u"]["email"] . "' AND `product_product_id`='" . $latest_data["product_id"] . "'");
                            $watchlist_num = $watchlist_rs->num_rows;

                            if ($watchlist_num == 1) {
                        ?>
                                <span style="display: flex; justify-content: center; align-items: center; cursor: pointer;"
                                    onclick="addToWatchlist(<?php echo $latest_data['product_id']; ?>);">
                                    <i class='bx bxs-heart bx-border-circle bx-sm bx-flashing text-danger'
                                        id="heart<?php echo $latest_data['product_id']; ?>"></i>
                                </span>
                            <?php
                            } else {
                            ?>
                                <span style="display: flex; justify-content: center; align-items: center; cursor: pointer;"
                                    onclick="addToWatchlist(<?php echo $latest_data['product_id']; ?>);">
                                    <i class='bx bx-cart-add bx-md bx-flashing text-info'
                                        id="heart<?php echo $latest_data['product_id']; ?>"></i>
                                </span>
                        <?php
                            }
                        }

                        ?>
                        <p class="text-center mt-1">Rs. <?php echo $latest_data["product_price"]; ?> .00</p>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-12 text-center">
                    <p class="h3 fw-bold text-danger">No Latest Items To Preview Yet !</p>
                    <img src="resources/logo design/No Product Image.jpg" style="width: 100px;"
                        class="img-fluid" alt="No Item.....">
                </div>
            <?php
            }
            ?>
            <a href="latestProduct.php" class="btn btn-outline-dark col-12">More Information Click This !</a>
        </div>
    </div>

    <div class="col-12">
        <hr class="border-primary" />
    </div>


    <!---Offer--->
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item  active">
                <img src="img/sale photo_1.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Modern Fashion</h5>
                    <p>Online Fashion Store</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <hr class="border-primary" />
    </div>

    <!--offer Product-->

    <div class="small-container">
        <h2 class="title">OFFER DESIGN</h2>
        <div class="row">
            <?php
            $offer_rs = Database::search("SELECT * FROM `product` WHERE `product_type_p_type_id`='3' 
            AND `status_status_id`='1' ORDER BY `p_date_time_add` DESC LIMIT 4 OFFSET 0");

            $offer_num = $offer_rs->num_rows;

            if ($offer_num > 0) {
                for ($f = 0; $f < $offer_num; $f++) {
                    $offer_data = $offer_rs->fetch_assoc();
            ?>

                    <!--design-->
                    <div class="lb1 col-3">

                        <?php
                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id` ='" . $offer_data["product_id"] . "'");
                        $img_num = $img_rs->num_rows;
                        $img_data = $img_rs->fetch_assoc();

                        if ($img_num > 0) {
                        ?>
                            <a href="singleProduct.php?id=<?php echo $offer_data["product_id"]; ?>">
                                <img src="<?php echo $img_data["p_img_path"]; ?>">
                            </a>
                        <?php
                        } else {
                        ?>
                            <a href="singleProduct.php?id=<?php echo $offer_data["product_id"]; ?>">
                                <img src="resources/logo design/No Product Image.jpg">
                            </a>
                        <?php
                        }
                        ?>
                        <span class="badge rounded-pill text-bg-success mt-1" style="align-items: center; display: flex; justify-content: center;">
                            OFFER
                        </span>
                        <h4 class="text-center"><?php echo $offer_data["product_title"]; ?></h4>

                        <?php
                        if (isset($_SESSION["u"])) {
                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
                            `user_email`='" . $_SESSION["u"]["email"] . "' AND `product_product_id`='" . $offer_data["product_id"] . "'");
                            $watchlist_num = $watchlist_rs->num_rows;

                            if ($watchlist_num == 1) {
                        ?>
                                <span style="display: flex; justify-content: center; align-items: center; cursor: pointer;"
                                    onclick="addToWatchlist(<?php echo $offer_data['product_id']; ?>);">
                                    <i class='bx bxs-heart bx-border-circle bx-sm bx-flashing text-danger'
                                        id="heart<?php echo $offer_data['product_id']; ?>"></i>
                                </span>
                            <?php
                            } else {
                            ?>
                                <span style="display: flex; justify-content: center; align-items: center; cursor: pointer;"
                                    onclick="addToWatchlist(<?php echo $offer_data['product_id']; ?>);">
                                    <i class='bx bx-cart-add bx-md bx-flashing text-info'
                                        id="heart<?php echo $offer_data['product_id']; ?>"></i>
                                </span>
                        <?php
                            }
                        }

                        ?>
                        <p class="text-center mt-1">Rs. <?php echo $offer_data["product_price"]; ?> .00</p>
                    </div>

                <?php
                }
            } else {
                ?>
                <div class="col-12 text-center">
                    <p class="h3 fw-bold text-danger">No Offer Items To Preview Yet !</p>
                    <img src="resources/logo design/No Product Image.jpg" style="width: 100px;"
                        class="img-fluid" alt="No Item.....">
                </div>
            <?php
            }
            ?>
            <a href="offerProduct.php" class="btn btn-outline-dark col-12">More Information Click This !</a>
        </div>
    </div>

    <div class="col-12">
        <hr class="border-primary" />
    </div>

    <!---brands--->

    <div class="brands h_brand1">
        <div class="small-container">
            <h2 class="title">OUR BRANDS</h2>
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

    <!-- footer --->

    <?php
    include "footer.php";
    ?>

    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/script.js"></script>
</body>

</html>