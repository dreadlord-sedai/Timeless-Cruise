<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" href="resources/logo design/fashin_logo.png" />

    <style>
        .input-box {
            position: relative;
            width: 100%;
            height: 50px;
        }

        .input-box input {
            width: 100%;
            height: 100%;
            background: transparent;
            border: none;
            outline: none;
            font-size: 16px;
            color: #fff;
            font-weight: 600;
            border-bottom: 2px solid #fff;
            padding-right: 23px;
            transition: .5s;
        }

        .input-box input:focus,
        .input-box input:valid {
            border-bottom: 2px solid #fff;
        }

        .input-box label {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            font-size: 16px;
            color: #fff;
            transition: .5s;
        }

        .input-box input:focus~label,
        .input-box input:valid~label {
            top: -5px;
            color: #fff;
        }

        .input-box i {
            position: absolute;
            top: 50%;
            right: 0;
            font-size: 18px;
            transform: translateY(-50%);
            transition: .5s;
        }

        .input-box input:focus~i,
        .input-box input:valid~i {
            color: #fff;
        }

        .buttonlogin {
            position: relative;
            width: 100%;
            height: 45px;
            background: transparent;
            border-radius: 40px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            border: 2px solid #fff;
            overflow: hidden;
            z-index: 1;

        }

        .buttonlogin::before {
            content: "";
            position: absolute;
            height: 300%;
            width: 100%;
            background: linear-gradient(#DB4437, #0F9D58, #4285F4, #0F9D58);
            top: -100%;
            left: 0;
            z-index: -1;
            transition: .5s;
        }

        .buttonlogin:hover::before {
            top: 0;
        }
    </style>

    <title>Online Fashion Store | Sign In </title>
</head>

<body>

    <div class="container-fluid d1">
        <div class="row d2">
            <div class="content logD1">
                <img src="" id="image">

                <script type="text/javascript">
                    let image = document.getElementById('image');
                    let images = ['fashion_model_1.jpg', 'fashion_model_4.jpg', 'fashion_model_3.jpg', 'fashion_model_2.jpg']
                    setInterval(function() {
                        let random = Math.floor(Math.random() * 4);
                        image.src = images[random];
                    }, 4000);
                </script>
            </div>

            <div class="loginform">

                <div class="col-12 d-none" id="msgdiv1">
                    <div class="alert alert-primary" role="alert" id="msg1"></div>
                </div>

                <h3 class="Flogin1">Good To See You Again!</h3>

                <form class="Flogin1">
                    <?php

                    $email = "";
                    $password = "";

                    if (isset($_COOKIE["email"])) {
                        $email = $_COOKIE["email"];
                    }

                    if (isset($_COOKIE["password"])) {
                        $password = $_COOKIE["password"];
                    }

                    ?>

                    <div class="form-floating mb-3 rounded-2 ">
                        <input type="email" class="form-control" placeholder="name@example.com" id="email2"
                            value="<?php echo $email; ?>">
                        <label>Email address</label>
                    </div>

                    <div class="form-floating mb-3 rounded-2 ">
                        <input type="password" class="form-control " placeholder="password" id="password2"
                            value="<?php echo $password; ?>" />
                        <label>Password</label>
                    </div>

                    <div class="remember-forgot mt-4 mb-4">
                        <label class="form-label fw-bold Flogin1">
                            <input type="checkbox" id="rememberMe"> Remember Me
                        </label>

                        <a href="forgotpw1.php" class="fw-bold Flogin1">
                            Forgot Password?
                        </a>

                    </div>

                    <div class="col-12">
                        <div class="row">
                            <div class="col-6 d-grid">
                                <button class="btn btn-primary fw-bold" onclick="signIn(); btnsign();">
                                    SIGN IN
                                </button>
                            </div>
                            <div class="col-6 d-grid">
                                <a href="signUp.php" class="btn btn-primary fw-bold">
                                    SIGN UP
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="text-center p-md-3 logT1">
                        <p class="fw-bold mx-3 mb-0 text-muted">OR</p>
                    </div>

                    <div>
                        <div class="input-box animation text-light">
                            <button class="buttonlogin" type="submit">Sign in with Google</button>
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