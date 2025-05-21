<?php
include "connection.php";
?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Purchase History | Fashion Store</title>

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
            background-image: url("resources/logo\ design/transactionhistory.png");
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>

    <?php
    include "header.php";

    if ($_SESSION["u"]) {
        $email = $_SESSION["u"]["email"];

        $invoice_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON
        invoice.product_product_id=product.product_id WHERE `invoice`.`user_email`='" . $email . "'");
        $invoice_num = $invoice_rs->num_rows;
    ?>
        <div class="small-container">
            <div class="mt-5">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item text-bold fw-bold">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Purchased History</li>
                    </ol>
                </nav>
            </div>

            <div class="PH1 text-center">
                <h1>Purchased History</h1>
            </div>

            <div class="card mb-3 mx-0 col-12">
                <div class="row g-0">

                    <?php
                    if ($invoice_num == 0) {
                    ?>
                        <!-- empty design-->
                        <div class="col-12 emptyView"></div>
                        <div class="col-12 text-center">
                            <label class="form-label fs-1 fw-bold">
                                No Purchased Items Yet
                            </label>
                            <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                <a href="index.php" class="btn btn-primary fs-4 fw-bold">Shopping Now</a>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <?php
                        for ($x = 0; $x < $invoice_num; $x++) {
                            $invoice_data = $invoice_rs->fetch_assoc();
                        ?>
                            <!--purchased Design-->
                            <div class="col-md-4 p-1 aj1">
                                <?php
                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                `product_product_id`='" . $invoice_data["product_product_id"] . "'");
                                $img_num = $img_rs->num_rows;
                                $img_data = $img_rs->fetch_assoc();

                                if ($img_num > 0) {
                                ?>
                                    <a href="singleProduct.php?id=<?php echo $invoice_data["product_id"]; ?>">
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                            data-bs-content="<?php echo $invoice_data["product_desciption"]; ?>"
                                            title="<?php echo $invoice_data["product_title"]; ?>">
                                            <img src="<?php echo $img_data["p_img_path"]; ?>"
                                                class="img-fluid rounded" style="max-width: 200px;">
                                        </span>
                                    </a>
                                    <?php
                                } else {
                                    ?>
                                        <a href="singleProduct.php?id=<?php echo $invoice_data["product_id"]; ?>">
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus"
                                                data-bs-content="<?php echo $invoice_data["product_desciption"]; ?>"
                                                title="<?php echo $invoice_data["product_title"]; ?>">
                                                <img src="img/No item.png" class="img-fluid rounded" style="max-width: 200px;">
                                            </span>
                                        </a>

                                    <?php
                                }
                                    ?>
                            </div>

                            <div class="col-md-5 ">
                                <div class="card-body">
                                    <h4 class="card-title text-center text-secondary">
                                        Order ID <br> <?php echo $invoice_data["order_id"]; ?>
                                    </h4>
                                    <br>
                                    <div class="text-center">
                                        <span class="fw-bold text-success fs-5">
                                            Order Size: <?php echo $invoice_data["o_size"]; ?>
                                        </span>
                                        <br>
                                        <span class="fw-bold text-primary fs-5">
                                            Order Quantity: <?php echo $invoice_data["order_qty"]; ?> Item
                                        </span>
                                        <br>
                                        <span class="fw-bold text-danger fs-5">
                                            Payment : Rs. <?php echo $invoice_data["total"]; ?> .00
                                        </span>
                                        <br>
                                        <span class="fw-bold text-dark fs-5">
                                            Order Data : <?php echo $invoice_data["order_date"]; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card-body d-grid">
                                    <a class="btn btn-outline-warning mb-2" onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);">
                                        FeedBack
                                    </a>
                                </div>
                            </div>

                            <!-- model -->
                            <div class="modal" tabindex="-1" id="feedbackModal<?php echo $invoice_data['product_id']; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h7 class="modal-title fw-bold text-primary">
                                                FeedBack
                                            </h7>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="text-center col-12">
                                                        <h5>
                                                            <?php echo $invoice_data["product_title"]; ?>
                                                        </h5>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold">Email</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" class="form-control" id="mail"
                                                                    value="<?php echo $email; ?>" disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold">Feedback</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <textarea class="form-control" cols="50" rows="12"
                                                                    id="feed"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary"
                                                onclick="saveFeedback(<?php echo $invoice_data['product_id']; ?>);">
                                                Save Feedback
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- model -->
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="col-12">
            <hr class="border-primary" />
        </div>

        <div class="small-container text-center">
            <div class="row col-12" style="justify-content: space-around;">
                <a href="purchasedHistory.php" class="btn btn-danger col-5 fw-bold">
                    Cart
                </a>
                <a href="cart.php" class="btn btn-info col-5 fw-bold" style="color: #fff;">
                    Watchlist
                </a>
            </div>
        </div>

        <div class="col-12">
            <hr class="border-primary" />
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

        <!--footer-->
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

<?php
    } else {
        echo ("Please Login To Your Account");
    }
?>