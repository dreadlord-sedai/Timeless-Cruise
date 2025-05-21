<?php

include "connection.php";

if (isset($_GET["order"])) {
    $odate = $_GET["order"];

    $order_rs = Database::search("SELECT * FROM `invoice` WHERE `order_date`='" . $odate . "'");
    $order_num = $order_rs->num_rows;

    if ($order_num == 1) {
        $selected_data = $order_rs->fetch_assoc();

        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "'");
        $user_data = $user_rs->fetch_assoc();

        $product_rs = Database::search("SELECT * FROM `product` WHERE `product_id`='" . $selected_data["product_product_id"] . "'");
        $product_data = $product_rs->fetch_assoc();
?>
        <div class="table-responsive" style="padding: 10px;">
            <table class="table caption-top table-bordered">
                <caption class="text-center text-primary fw-bold">
                    Search Results
                </caption>
                <thead class="table-primary">
                    <tr>
                        <th scope="col" class="col-2">ORDER ID</th>
                        <th scope="col" class="col-1">QUANTITY</th>
                        <th scope="col" class="col-4">PRODUCT INFORMATION</th>
                        <th scope="col" class="col-2">PAYMENT</th>
                        <th scope="col" class="col-2">PAYMENT_DATE</th>
                        <th scope="col" class="col-1">UPDATE</th>
                    </tr>
                </thead>
                <tbody class="table-danger">
                    <tr>
                        <a href="#">
                            <th scope="row" class="text-light table-primary" style="cursor: pointer;">
                                <?php echo $selected_data["order_id"]; ?>
                            </th>
                        </a>
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
            </table>
        </div>
<?php
    } else {

        echo ("Invalid Order Date");
    }
} else {
    echo ("Please add an Order Date First");
}
?>