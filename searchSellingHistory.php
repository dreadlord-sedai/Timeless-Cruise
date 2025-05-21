<?php

include "connection.php";

if (isset($_GET["id"])) {
    $sid = $_GET["id"];

    $sorder_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $sid . "'");
    $sorder_num = $sorder_rs->num_rows;

    if ($sorder_num == 1) {
        $selected_data = $sorder_rs->fetch_assoc();

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
                        <th scope="col" class="col-1">INVOICE ID</th>
                        <th scope="col" class="col-2">ORDER ID</th>
                        <th scope="col" class="col-4">PRODUCT INFORMATION</th>
                        <th scope="col" class="col-1">QUANTITY</th>
                        <th scope="col" class="col-2">PRICE</th>
                        <th scope="col" class="col-2">CUSTOMER</th>
                    </tr>
                </thead>
                <tbody class="table-danger">
                    <tr class="text-primary fw-bold">
                        <th scope="row" class="text-danger">
                            <?php echo $selected_data["invoice_id"]; ?>
                        </th>
                        <td class="text-danger">
                            <?php echo $selected_data["order_id"]; ?>
                        </td>
                        <td class="text-danger">
                            <?php echo $product_data["product_title"]; ?>
                        </td>
                        <td class="text-danger">
                            <?php echo $selected_data["order_qty"]; ?>
                        </td>
                        <td class="text-danger">
                            Rs. <?php echo $selected_data["total"]; ?>.00
                        </td>
                        <td class="text-danger">
                            <?php echo $user_data["fname"] . " " . $user_data["lname"]; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

<?php
    } else {
        echo ("Invalid Order ID");
    }
} else {
    echo ("Please add an Order ID First");
}

?>