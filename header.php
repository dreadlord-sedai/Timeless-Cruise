<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />

    <style>
        .signo12{
            cursor: pointer;
        }
    </style>

</head>

<body>

    <div class="col-12">
        <div class="row">
            <div class="offset-lg-1 col-12 col-lg-3 align-self-start mt-2">

                <?php
                session_start();

                if (isset($_SESSION["u"])) {
                    $data = $_SESSION["u"];

                ?>
                    <span class="text-lg-start text-primary">
                        <b>Hello ,</b><?php echo $data["fname"]; ?>
                    </span>
                    <span class="text-lg-start text-dark fw-bold signo12" onclick="signout();">
                        | SignOut
                    </span>

                <?php
                } else {
                ?>
                    <a href="login.php" class="text-decoration-none fw-bold">Sign In or Register</a>
                <?php

                }

                ?>
            </div>
        </div>

        <div class="col-12 col-lg-3 offset-lg-5 align-self-end head1" style="text-align: center;">
            <div class="row">
                <div class="col-12 col-lg-6 dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                    <ul class="dropdown-menu head2">
                        <li><a class="dropdown-item" href="index.php">Home</a></li>
                        <li><a class="dropdown-item" href="products.php">Product</a></li>
                        <li><a class="dropdown-item" href="search.php">Search</a></li>
                        <li><a class="dropdown-item" href="about.php">Contact</a></li>
                        <li><a class="dropdown-item" href="userProfile.php">Account</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <script src="js/script.js"></script>
</body>

</html>