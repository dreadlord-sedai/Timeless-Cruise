<?php
include "connection.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="resources/logo design/fashin_logo.png" />

    <title>Online Fashion Store | Sign Up</title>
</head>

<body>

    <div class="container-fluid d1">
        <div class="row d2">
            <div class="content logD1">
                <img src="" id="image">

                <script type="text/javascript">
                    let image = document.getElementById('image');
                    let images = ['fashion_model_2.jpg', 'fashion_model_S1.jpg']
                    setInterval(function() {
                        let random = Math.floor(Math.random() * 2);
                        image.src = images[random];
                    }, 2000);
                </script>
            </div>

            <div class="loginform">

                <div class="col-12 d-none" id="msgdiv">
                    <div class="alert alert-primary" role="alert" id="msg"></div>
                </div>

                <h3 class="Flogin1 text-center text-bold">Online Fashion Store !</h3>

                <form class="Flogin1">
                    <div class="row">
                        <div class="rounded-2 col-6">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="fname" />
                        </div>
                        <div class="rounded-2 col-6">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="lname" />
                        </div>
                    </div>

                    <div class="form-floating mb-3 rounded-2  mt-3">
                        <input type="email" class="form-control" placeholder="name@example.com" id="email" />
                        <label>Email address</label>
                    </div>

                    <div class="form-floating mb-3 rounded-2  mt-3">
                        <input type="password" class="form-control" id="password" placeholder="Password" />
                        <label>Password</label>
                    </div>

                    <?php
                    $gender_rs = Database::search("SELECT * FROM `gender`");
                    ?>

                    <div class="row">
                        <div class="rounded-2 col-6">
                            <label>Mobile</label>
                            <input type="text" class="form-control" id="mobile" />
                        </div>
                        <div class="rounded-2 col-6">
                            <select class="form-select" size="3" aria-label="Size 3 select example" id="gender">
                                <option style="color: #7091E6;" disabled>Select Gender</option>
                                <?php
                                for ($x = 0; $x < $gender_rs->num_rows; $x++) {
                                    $gender_data = $gender_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $gender_data["gender_id"]; ?>"
                                        <?php
                                        if (!empty($details_data["gender_id"])) {
                                            if ($gender_data["gender_id"] == $details_data["gender_id"]) {
                                        ?>selected<?php
                                                }
                                            }
                                                    ?>>
                                        <?php echo $gender_data["gender_name"]; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-6 d-grid">
                                <a href="login.php" class="btn btn-primary fw-bold">
                                    SIGN IN
                                </a>
                            </div>

                            <div class="col-6 d-grid">
                                <button class="btn btn-primary fw-bold" onclick="signup(); btnup();">
                                    SIGN UP
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>