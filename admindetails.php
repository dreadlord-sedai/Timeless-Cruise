<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Information | Online Fashion Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="resources/logo design/fashin_logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .admindetails1 {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="AT1">

    <div class="mt-4" style="margin-left: 20px;">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-bold"><a href="dashboard.php">Home</a></li>
            </ol>
        </nav>
    </div>

    <?php
    session_start();
    if (isset($_SESSION["au"])) {
        $email = $_SESSION["au"]["admin_email"];

        $a_details_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email`='" . $email . "'");
        $a_details_data = $a_details_rs->fetch_assoc();
    }
    ?>

    <div class="container light-style flex-grow-1 container-p-y">
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="account-general">

                            <!--Image-->

                            <div class="card-body media align-items-center admindetails1">
                                <img src="resources/profile image/dp boy profile pic.jpg" alt
                                    class="d-block ui-w-80" style="border-radius: 50%">
                            </div>

                            <!--User details-->

                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control mb-1" readonly value="<?php echo $a_details_data["a_name"]; ?>">
                                </div>
                                <div class=" form-group">
                                    <label class="form-label">E-mail</label>
                                    <input type="text" class="form-control mb-1" readonly value="<?php echo $email ?>">
                                </div>
                                <div class=" form-group">
                                    <label class="form-label">Registered Date</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $a_details_data["a_registerd_date"]; ?>">
                                </div>
                                <div class=" form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $a_details_data["a_mobile"]; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src=" https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>