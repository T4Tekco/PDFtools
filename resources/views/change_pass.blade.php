<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">

    <title>Change Pass</title>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #333333;">
            <div class="container-fluid">
                <a class="navbar-brand" href="">
                    <img width="40px" height="40px" src="/images/logo.png" alt="">
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a style="color: white;" class="nav-link active" aria-current="page" href="">Home</a>
                        </li>
                        <li style="margin-left: 34px;" class="nav-item">
                            <a style="color: white;" class="nav-link" href="{{ route('profile')}}">Profile</a>
                        </li>

                        
                        <!-- Dropdown -->
                        <li class="nav-item">
                            <a style="position: absolute;text-align: start; right: 20px;color:white" class="nav-link" href="{{ route('login')}}">Log Out</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="images/changepass.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div style="margin-top: 15%;" class=" row justify-content-center shadow p-3 mb-5 bg-body rounded">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Change Password<strong> </strong></h3>
                                <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
                                    adipisicing.</p> -->
                            </div>
                            <form action="#" method="post">
                                <div class="form-group last mb-4">
                                    <label for="password">Old Password</label>
                                    <input type="password" class="form-control" id="password">

                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" id="password">

                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control" id="password">

                                </div>
                                <!-- button -->
                                <input type="submit" style="background-color: purple;border:1px solid purple;height: 45px;" value="Log In" class="btn text-white btn-block btn-primary">
                                <hr>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <style>
        .ul {
            text-align: center;
        }

        .ul .li {
            display: inline-block;
            margin-right: 15px;
            transition: all 0.3s ease-in-out;
        }

        .ul .li:hover .submenu {
            height: 150px;
            /* chiều cao của hover dropdown */
        }

        .ul .li:hover .a {
            color: #000000;
        }

        .ul .li:hover .a::before {
            visibility: visible;

            /* transform: scale(1, 1); */
        }

        .ul .li .submenu {
            overflow: hidden;
            position: absolute;
            left: 0;
            width: 100%;
            background-color: white;
            height: 0;
            line-height: 40px;
            box-sizing: border-box;
            transition: height 0.3s ease-in-out;
            transition-delay: 0.1s;
        }

        .ul .li .submenu .a {
            color: #fff;
            margin-top: 20px;
            font-size: 16px;
        }

        .ul .li .submenu .a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .ul .li .a {
            color: #999;
            display: block;
            padding: 8px 0 7px 0px;
            margin: 0 0 10px;
            text-decoration: none;
            position: relative;
        }

        .ul .li .a::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 3px;
            bottom: -10px;
            left: 0px;
            background-color: #3862a0;
            transition: all 0.2s ease-in-out;
            transform: scale(0, 0);
            visibility: hidden;
        }
    </style>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/scriptss.js"></script>
</body>
<footer class="" style="background-color: #333333;">

    <div style="display: flex;justify-content: center;">
        <div class="footer-left">

            <img width="200px" height="200px" src="/images/logo.png" alt="">

            <p class="" style="color:white">Công ty TNHH T4TEK © 2022</p>
        </div>

        <div class="" style="color:white;margin: 55px 200px 0 200px;">
            <div class="" style="margin-bottom: 20px;width: 500px;height: 50px;">

                <p style="color:white"><i class="fa-solid fa-location-dot" style="margin-right: 5px;"></i>L18-11-13, Tầng 18 Tòa nhà Vincom Center Đồng Khởi, Số 72 Lê Thánh Tôn, Phường Bến Nghé, Quận 1, Thành phố Hồ Chí Minh</p>
            </div>
            <div style="margin-bottom: 20px;">
                <p style="color:white"> <i class="fa-solid fa-phone" style="margin-right: 5px;"></i> 0965643046</p>

            </div>
            <div>
                <p style="color:white"><i class="fa-solid fa-envelope" style="margin-right: 5px;"></i>contact@t4tek.co</p>
            </div>

        </div>

        <div class="" style="display: flex;">
            <a href="">
                <div style="margin:55px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="/images/fb.png" alt="">
                </div>
            </a>
            <a href="http://zalo.me/518410350895218680?src=qr">
                <div style="margin:55px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="https://cdn.haitrieu.com/wp-content/uploads/2022/01/Logo-Zalo-Arc.png" alt="">
                </div>
            </a>
            <a href="">
                <div style="margin:55px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Instagram_logo_2016.svg/2048px-Instagram_logo_2016.svg.png" alt="">
                </div>
            </a>
            <a href="">
                <div style="margin:55px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="/images/link.png" alt="">
                </div>
            </a>
        </div>
    </div>

</footer>

</html>