<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Online Fashion Store | Admin </title>

    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/adminsign.css" />
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
            background: linear-gradient(#7091E6, #ADBBDA, #7091E6, #ADBBDA);
            top: -100%;
            left: 0;
            z-index: -1;
            transition: .5s;
        }

        .buttonlogin:hover::before {
            top: 0;
        }

        .ofs1 {
            font-family: monospace;
        }
    </style>
</head>

<body class="ofs12">
    <div class="admin6">
        <div class="admin1">
            <div class="admin2">
                <div class="col-12 d-none" id="msgdiv3" style="margin-bottom: 50px;">
                    <div class="alert alert-primary" role="alert" id="msg3"></div>
                </div>

                <h2 class="ofs1 mt-5">Online Fashion Store</h2>
                <form action="#">
                    <div class="admin3">
                        <span class="admin4"><ion-icon name="mail"></ion-icon></span>
                        <input type="email" required id="a">
                        <label>Email</label>
                    </div>
                    <div class="input-box animation">
                        <button class="buttonlogin" type="submit" style="color: #fff;" onclick="adminVerification();
                        adveriB(); ">
                            Verification
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>

    <script src="js/script.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>