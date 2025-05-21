<?php
session_start();
include "connection.php";

if (isset($_SESSION["au"])) {
    $email = $_SESSION["au"]["admin_email"];
    $pageno;
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Product | Online Fashion Store</title>

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
            <a href="#" class="brand">
                <i class='bx bxl-product-hunt'></i>
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
                    <li class="active">
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
                <a href="#" class="nav-link">Product List</a>

                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Product Name...">
                        <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                    </div>
                </form>

                <a href="#" class="notification">
                    <i class='bx bxs-bell'></i>
                    <span class="num">8</span>
                </a>

                <a href="admindetails.php" class="profile">
                    <img src="resources/profile image/profile picture.jpg">
                </a>
            </nav>

            <!--Selling-->

            <div class="table-responsive" style="padding: 10px;">
                <table class="table caption-top table-bordered">
                    <caption class="text-center text-primary"></caption>
                    <thead class="table-secondary">
                        <tr>
                            <th scope="col" class="col-1 text-center">ID</th>
                            <th scope="col" class="col-5">PRODUCT INFORMATION</th>
                            <th scope="col" class="col-2">PRICE</th>
                            <th scope="col" class="col-4">Editor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET["page"])) {
                            $pageno = $_GET["page"];
                        } else {
                            $pageno = 1;
                        }

                        $product_rs = Database::search("SELECT * FROM `product`");
                        $product_num = $product_rs->num_rows;

                        $results_per_page = 10;
                        $number_of_pages = ceil($product_num / $results_per_page);

                        $page_results = ($pageno - 1) * $results_per_page;
                        $selected_rs = Database::search("SELECT * FROM `product` LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                        $selected_num = $selected_rs->num_rows;
                        for ($x = 0; $x < $selected_num; $x++) {
                            $selected_data = $selected_rs->fetch_assoc();
                        ?>
                            <tr>
                                <th scope="row" class="text-center">
                                    <?php echo $selected_data["product_id"]; ?>
                                </th>
                                <td><?php echo $selected_data["product_title"]; ?></td>
                                <td>
                                    Rs. <?php echo $selected_data["product_price"]; ?>.00
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="toggle<?php echo $selected_data["product_id"]; ?>"
                                            onchange="changeStatus(<?php echo $selected_data['product_id']; ?>);"
                                            <?php
                                            if ($selected_data['status_status_id'] == 2) {
                                            ?>
                                            checked
                                            <?php
                                            }
                                            ?>>
                                        <label class="form-check-label" for="toggle<?php echo $selected_data["product_id"]; ?>">
                                            <?php
                                            if ($selected_data['status_status_id'] == 2) {
                                            ?>
                                                Make Your Product Active
                                            <?php
                                            } else {
                                            ?>
                                                Make Your Product Deactive
                                            <?php
                                            }
                                            ?>
                                        </label>
                                        </label>
                                    </div>
                                    <a class="btn btn-primary col-3" href="adminProductUpdate.php?id=<?php echo $selected_data["product_id"] ?>">
                                        Update
                                    </a>
                                    <a class="btn btn-danger col-3" onclick="removeAdminProduct(<?php echo $selected_data['product_id']?>)">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>


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