<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Search | Online Fashion Store</title>

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="icon" href="resources/logo design/fashin_logo.png" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body class="search12">
    <div class="search1" id="sch1">
        <header>
            <div class="search2">
                <div class="search3">
                    <a class="navbar-brand" href="home.php">
                        <img src="resources/logo design/fashin_logo.png" style="width: 50px;">
                    </a>
                    <div class="search6"><a href="index.php">Online Fashion Store</a></div>
                    <nav>
                        <a href="#" class="search7">
                            <i class='bx bx-search bx-md'></i>
                        </a>
                    </nav>
                </div>

                <div class="search4">
                    <div class="search5">
                        <form action="">
                            <button type="submit">
                                <i class='bx bx-search'></i>
                            </button>
                            <input type="search" placeholder="Search design....">
                            <select>
                                <option value="sp">Sort Product</option>
                                <option value="high">High to low</option>
                                <option value="low">Low to high</option>
                                <option value="new">Newest to oldest</option>
                                <option value="old">Oldest to newest</option>
                            </select>
                        </form>
                        <div class="post-suggest1">
                            <div class="post1">
                                <h4>Popular</h4>
                                <ul>
                                    <li>
                                        <div class="thumbnail1">
                                            <a href="#">
                                                <img src="fashion_model_2.jpg" alt="fashion image">
                                            </a>
                                        </div>
                                        <div class="meta1">
                                            <h3>
                                                <a href="#">
                                                    Welcome to Online Fashion Store, where fashion meets passion!
                                                </a>
                                            </h3>
                                            <span><i class='bx bxs-calendar'></i>May 24, 2004</span>
                                            <span><i class='bx bx-show'></i>350 view</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="thumbnail1">
                                            <a href="#">
                                                <img src="fashion_model_2.jpg" alt="fashion image">
                                            </a>
                                        </div>
                                        <div class="meta1">
                                            <h3>
                                                <a href="#">
                                                    Welcome to Online Fashion Store, where fashion meets passion!
                                                </a>
                                            </h3>
                                            <span><i class='bx bxs-calendar'></i>May 24, 2004</span>
                                            <span><i class='bx bx-show'></i>800 view</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="thumbnail1">
                                            <a href="#">
                                                <img src="fashion_model_2.jpg" alt="fashion image">
                                            </a>
                                        </div>
                                        <div class="meta1">
                                            <h3>
                                                <a href="#">
                                                    Welcome to Online Fashion Store, where fashion meets passion!
                                                </a>
                                            </h3>
                                            <span><i class='bx bxs-calendar'></i>May 24, 2004</span>
                                            <span><i class='bx bx-show'></i>600 view</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="link1">
                                <h4>CATEGORY</h4>
                                <ul>
                                    <li><a href="#">T-SHIRTS</a></li>
                                    <li><a href="#">DRESSES</a></li>
                                    <li><a href="#">ACCESSORIES</a></li>
                                    <li><a href="#">SAREE</a></li>
                                    <li><a href="#">LINGERIE & NIGHTWARE</a></li>
                                    <li><a href="#">JEANS</a></li>
                                    <li><a href="#">SPORTS DRESS</a></li>
                                </ul>
                            </div>
                            <a href="#" class="close"><i class='bx bx-window-close'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!--NO items--->
        <div class="col-12">
            <img src="img/No item.png" class="img-fluid" alt="No Item">
        </div>

        <!--footer-->

        <?php
        include "footer.php";
        ?>

    </div>



    <!---js--->

    <script type="text/javascript">
        const searchButton = document.querySelector('.search7'),
            closeButton = document.querySelector('.close'),
            classTo = document.querySelector('.search1');

        searchButton.addEventListener('click', function() {
            classTo.classList.toggle('showsearch')
        })

        closeButton.addEventListener('click', function() {
            classTo.classList.remove('showsearch')
        })
    </script>

    <script src="js/script.js"></script>
</body>

</html>