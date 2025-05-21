<?php
include "connection.php";
session_start();

if (isset($_SESSION["au"])) {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Order Information | Online Fashion Store</title>

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
        <!-- sidebar -->
        <section id="sidebar" style="background-color:#ADBBDA;">
            <a href="" class="brand">
                <i class='bx bxs-bell'></i>
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
                    <li>
                        <a href="adminProductAdd.php">
                            <i class='bx bxs-cart-add'></i>
                            <span class="text">Product Adding</span>
                        </a>
                    </li>
                    <li class="active">
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
                <a href="#" class="nav-link">Order Information</a>

                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Order Date..." id="order_date">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search' onclick="orderdate();"></i>
                        </button>
                    </div>
                </form>

                <a href=" admindetails.php" class="profile">
                    <img src="resources/profile image/profile picture.jpg">
                </a>
            </nav>

            <!--order-->
            <div id="view_area_order">
            </div>

            <div class="table-responsive" style="padding: 10px;">
                <table class="table caption-top table-bordered">
                    <caption class="text-center text-primary"></caption>
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col" class="col-2">ORDER ID</th>
                            <th scope="col" class="col-1">QUANTITY</th>
                            <th scope="col" class="col-4">PRODUCT INFORMATION</th>
                            <th scope="col" class="col-2">PAYMENT</th>
                            <th scope="col" class="col-2">PAYMENT_DATE</th>
                            <th scope="col" class="col-1">UPDATE</th>
                        </tr>
                    </thead>
                    <?php
                    $query = "SELECT * FROM `invoice`";
                    $pageno;

                    if (isset($_GET["page"])) {
                        $pageno = $_GET["page"];
                    } else {
                        $pageno = 1;
                    }

                    $invoice_rs = Database::search($query);
                    $invoice_num = $invoice_rs->num_rows;

                    $results_per_page = 10;
                    $number_of_pages = ceil($invoice_num / $results_per_page);

                    $page_results = ($pageno - 1) * $results_per_page;
                    $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results);
                    $selected_num = $selected_rs->num_rows;

                    for ($i = 0; $i < $selected_num; $i++) {
                        $selected_data = $selected_rs->fetch_assoc();

                        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "'");
                        $user_data = $user_rs->fetch_assoc();

                        $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='" . $selected_data["product_product_id"] . "'");
                        $product_data = $product_rs->fetch_assoc();
                    ?>
                        <tbody>
                            <tr>

                                <th scope="row" class="text-light table-primary" style="cursor: pointer;">
                                    <a href="orderDetails.php?id=<?php echo $selected_data["product_product_id"]; ?>">
                                        <?php echo $selected_data["order_id"]; ?>
                                    </a>
                                </th>

                                <td class="text-center">
                                    <?php echo $selected_data["order_qty"]; ?>
                                </td>
                                <td class="text-light fw-bold table-primary">
                                    <?php echo $product_data["product_title"]; ?>
                                </td>
                                <td class="text-center">
                                    Rs. <?php echo $selected_data["total"]; ?>.00
                                </td>
                                <td class="text-light fw-bold table-primary">
                                    <?php echo $selected_data["order_date"]; ?>
                                </td>

                                <?php
                                if ($selected_data["order_status"] == 1) {
                                ?>
                                    <td class="text-center text-danger">
                                        <i class='bx bxs-purchase-tag bx-sm bx-flashing'
                                            onclick="purchaseTag('<?php echo $selected_data['order_id'] ?>');">
                                        </i>
                                    </td>
                                <?php
                                } else if ($selected_data["order_status"] == 2) {
                                ?>
                                    <td class="text-center text-success">
                                        <i class='bx bxs-purchase-tag bx-sm bx-flashing'
                                            onclick="purchaseTag('<?php echo $selected_data['order_id'] ?>');">
                                        </i>
                                    </td>
                                <?php

                                }
                                ?>
                            </tr>
                        </tbody>
                    <?php
                    }
                    ?>
                </table>

                <!--pagination -->
                <div class="text-center" style="display: flex; align-items: center; justify-content: center;">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" style="background: #fff; box-shadow: none;" href="
                            <?php
                            if ($pageno <= 1) {
                                echo ("#");
                            } else {
                                echo "?page=" . ($pageno - 1);
                            }

                            ?>">
                                    Previous
                                </a>
                            </li>

                            <?php
                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                if ($pageno == $x) {
                            ?>
                                    <li class="page-item active">
                                        <a class="page-link" style="background: #F9F9F9; border-color: #808080;"
                                            href="<?php echo "?page=" . ($x); ?>">
                                            <?php echo $x; ?>

                                        </a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link" style="background: #F9F9F9; border-color: #808080;"
                                            href="<?php echo "?page=" . ($x); ?>">
                                            <?php echo $x; ?>

                                        </a>
                                    </li>
                            <?php
                                }
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" style="background: #fff; box-shadow: none;" href="
                              <?php
                                if ($pageno >= $number_of_pages) {
                                    echo ("#");
                                } else {
                                    echo "?page=" . ($pageno + 1);
                                }
                                ?>">
                                    Next
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!--pagination-->
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