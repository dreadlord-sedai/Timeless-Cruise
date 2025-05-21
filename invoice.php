<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/invoice.css">
    <link rel="icon" href="resources/logo design/fashin_logo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Invoice | Online Fashion Store </title>
</head>

<body>

    <?php

    session_start();
    if (isset($_SESSION["u"])) {
        $mail = $_SESSION["u"]["email"];
        $oid = $_GET["id"];

        $invoice_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `user` ON invoice.user_email=
        user.email INNER JOIN `product` ON invoice.product_product_id=product.product_id WHERE
        `order_id`='" . $oid . "'");
        $invoice_data = $invoice_rs->fetch_assoc();

    ?>
        <div class="col-md-12 d-flex justify-content-center align-items-center" id="invoice_page">
            <div class="row">
                <div class="receipt-main col-xs-10 col-sm-10 col-md-12 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                    <div class="row">
                        <div class="col-12 btn-toolbar justify-content-end">
                            <button class="btn btn-danger me-2" onclick="printInvoice();">
                                <i class='bx bxs-printer'></i>
                                Print
                            </button>
                        </div>

                        <div class="receipt-header">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="receipt-left">
                                    <img class="img-responsive" alt="Onine fashion store"
                                        src="resources/logo design/fashin_logo.png"
                                        style="width: 71px; border-radius: 43px;">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                <div class="receipt-right">
                                    <h5>Online Fashion Store</h5>
                                    <p><i class='bx bxs-phone'></i>+94 78 795 7300</p>
                                    <p><i class='bx bx-envelope'></i>Online Fashion Store</p>
                                    <p><i class='bx bxs-location-plus'></i> Sri Lanka</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="receipt-header receipt-header-mid">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                <div class="receipt-right">
                                    <h5>Customer Details</h5>
                                    <p><b>Name :</b> <?php echo $invoice_data["fname"] . " " . $invoice_data["lname"]; ?></p>
                                    <p><b>Email :</b> <?php echo $mail ?></p>
                                    <p><b>Mobile :</b> <?php echo $invoice_data["mobile"]; ?></p>

                                    <?php
                                    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE
                                    `user_email`='" . $mail . "'");
                                    $address_data = $address_rs->fetch_assoc();
                                    ?>
                                    <p><b>Address :</b> <?php echo $address_data["address"]; ?></p>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 mt-3">
                                <div class="receipt-left">
                                    <h3>ORDER_ID </br> <?php echo $invoice_data["order_id"]; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="col-md-12">Product Size</td>
                                    <td class="col-md-12 text-center">
                                        <?php echo $invoice_data["o_size"]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-12">Product Cost</td>
                                    <td class="col-md-12 text-center">
                                        <?php echo $invoice_data["product_price"]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-12">Buy Quantity</td>
                                    <td class="col-md-12 text-center">
                                        <?php echo $invoice_data["order_qty"]; ?>
                                    </td>
                                </tr>

                                <?php

                                $order_shipping_rs = Database::search("SELECT * FROM `city` WHERE `city_id`
                                ='" . $address_data["city_city_id"] . "'");
                                $order_shipping_data = $order_shipping_rs->fetch_assoc();

                                $delivary = 0;

                                if ($order_shipping_data["district_district_id"] == 5) {
                                ?>
                                    <tr>
                                        <td class="col-md-12">Shipping Cost</td>
                                        <td class="col-md-12 text-center">
                                            <?php echo $invoice_data["delevery_fee_colombo"]; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <p>
                                                <strong>Total Amount: </strong>
                                            </p>
                                            <p>
                                                <strong>Payment Method: </strong>
                                            </p>
                                        </td>
                                        <td>
                                            <p class="text-center">
                                                <strong>
                                                    <?php echo $invoice_data["total"]; ?>
                                                </strong>
                                            </p>
                                            <p class="text-center">
                                                <strong> Online Payment</strong>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td class="text-right">
                                            <h2><strong>Payment: </strong></h2>
                                        </td>
                                        <td class="text-center text-danger">
                                            <h2>
                                                <strong><?php echo $invoice_data["total"]; ?></strong>
                                            </h2>
                                        </td>
                                    </tr>
                                <?php
                                } else {
                                ?>
                                    <tr>
                                        <td class="col-md-12">Shipping Cost</td>
                                        <td class="col-md-12 text-center">
                                            <?php echo $invoice_data["delevery_fee_other"]; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <p>
                                                <strong>Total Amount: </strong>
                                            </p>
                                            <p>
                                                <strong>Payment Method: </strong>
                                            </p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-center">
                                                <strong class="text-center">
                                                    <?php echo $invoice_data["total"]; ?>
                                                </strong>
                                            </p>
                                            <p class="text-center">
                                                <strong>Online Payment</strong>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>

                                        <td class="text-right">
                                            <h2><strong>Payment: </strong></h2>
                                        </td>
                                        <td class="text-center text-danger">
                                            <h2>
                                                <strong class="text-center">
                                                    <?php echo $invoice_data["total"]; ?>
                                                </strong>
                                            </h2>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="receipt-header receipt-header-mid receipt-footer">
                            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                                <div class="receipt-right">
                                    <p><b>Date :</b> <?php echo $invoice_data["order_date"]; ?></p>
                                    <h5 class="text-secondary">Thank You!</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php

    } else {
        echo ("Something Went Wrong, Try Again later");
    }
    ?>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
</body>

</html>