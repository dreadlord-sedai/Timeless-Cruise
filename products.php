<?php
include "connection.php";
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Product | Online Fashion Store</title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="resources/logo design/fashin_logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>

    <?php
    include "header.php";
    ?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid header">

            <a class="navbar-brand" href="home.php">
                <img src="resources/logo design/fashin_logo.png" style="width: 50px;">
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="products.php">Product</a>
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


            </div>
        </div>
    </nav>


    <div class="small-container">
        <div class="row2 row">
            <div class="product1">
                <select>
                    <option>Default Shorting</option>
                    <option>Short By Price</option>
                    <option>Short By popular</option>
                    <option>Short By rating</option>
                    <option>Short By Sale</option>
                </select>
            </div>

            <form class="d-flex" role="search">
                <input class="form-control me-2 mt-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary" type="submit">Search</button>
            </form>
        </div>

        <div class="row">

            <?php
            $product_rs = Database::search("SELECT * FROM `product` WHERE `status_status_id`='1' 
            ORDER BY `p_date_time_add`");

            $product_num = $product_rs->num_rows;

            if ($product_num > 0) {
                for ($x = 0; $x < $product_num; $x++) {
                    $product_data = $product_rs->fetch_assoc();
            ?>

                    <!--design-->
                    <div class="lb1 col-3">

                        <?php
                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_product_id` ='" . $product_data["product_id"] . "'");
                        $img_num = $img_rs->num_rows;
                        $img_data = $img_rs->fetch_assoc();

                        if ($img_num > 0) {
                        ?>
                            <a href="singleProduct.php?id=<?php echo $product_data["product_id"]; ?>">
                                <img src="<?php echo $img_data["p_img_path"]; ?>">
                            </a>
                        <?php
                        } else {
                        ?>
                            <a href="singleProduct.php?id=<?php echo $product_data["product_id"]; ?>">
                                <img src="resources/logo design/No Product Image.jpg">
                            </a>
                        <?php
                        }
                        ?>
                        <span class="badge rounded-pill text-bg-info mt-1" style="align-items: center; display: flex; justify-content: center;">
                            Online Fashion Store
                        </span>
                        <h4 class="text-center"><?php echo $product_data["product_title"]; ?></h4>

                        <?php
                        if (isset($_SESSION["u"])) {
                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE 
                            `user_email`='" . $_SESSION["u"]["email"] . "' AND `product_product_id`='" . $product_data["product_id"] . "'");
                            $watchlist_num = $watchlist_rs->num_rows;

                            if ($watchlist_num == 1) {
                        ?>
                                <span style="display: flex; justify-content: center; align-items: center; cursor: pointer;"
                                    onclick="addToWatchlist(<?php echo $product_data['product_id']; ?>);">
                                    <i class='bx bxs-heart bx-border-circle bx-sm bx-flashing text-danger'
                                        id="heart<?php echo $product_data['product_id']; ?>"></i>
                                </span>
                            <?php
                            } else {
                            ?>
                                <span style="display: flex; justify-content: center; align-items: center; cursor: pointer;"
                                    onclick="addToWatchlist(<?php echo $product_data['product_id']; ?>);">
                                    <i class='bx bx-cart-add bx-md bx-flashing text-info'
                                        id="heart<?php echo $product_data['product_id']; ?>"></i>
                                </span>
                        <?php
                            }
                        }

                        ?>
                        <p class="text-center mt-1">Rs. <?php echo $product_data["product_price"]; ?> .00</p>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="col-12 text-center">
                    <p class="h3 fw-bold text-danger">No Items To Preview Yet !</p>
                    <img src="resources/logo design/No Product Image.jpg" style="width: 100px;"
                        class="img-fluid" alt="No Item.....">
                </div>
            <?php
            }
            ?>
        </div>
    </div>


    <!-- footer --->

    <?php
    include "footer.php";
    ?>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>