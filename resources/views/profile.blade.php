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
    <link rel="stylesheet" href="css/styless.css">
    <title>Profile</title>
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
    <div style="padding-left:10em;padding-right:10em;margin-bottom: 100px;">
        <div class="d-flex flex-row" style="padding-top:100px;">

            <div class="mt-3 rounded shadow-sm flex-shrink-2 p-4 align-self-start" style="background-color:white;">
                <div class="text-center">
                    <img src="/images/a.svg" alt="" class="border rounded-circle" style="width:10em;height:10em">
                </div>
                <div class="fs-3 fw-bold mt-3 mb-2 text-center">username</div>
                <hr>
                <div class="d-flex align-items-center mb-1">
                    <p>E-Mail</p>
                </div>
                <div class="text-center mt-2">
                    <a href="{{ route('change_pass') }}" style="width: 100%;" class="btn btn-light btn-sm fw-semibold">Change Password</a>
                </div>
            </div>


            <div class="mt-3 rounded shadow-sm w-100 p-4 pt-0 pb-2 " style="margin-left:2%;background-color:white">
                <!-- key -->
                <form action="#" method="post">
                    <div class="form-group first">
                        <label for="username">Key</label>
                        <input type="text" class="form-control" id="username" disabled>
                    </div>
                    <!-- button -->
                    <input type="submit" style="background-color: purple;border:1px solid purple;height: 45px;" value="Get Key" class="btn text-white btn-block btn-primary">

                </form>


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