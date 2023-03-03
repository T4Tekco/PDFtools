<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <link rel="icon" href="/icons/iconpage.jpg" type="">
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
    <!-- dropdown -->
    <title>Login</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="images/log_in.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center shadow p-3 mb-5 bg-body rounded">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign In <strong> </strong></h3>
                                <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
                                    adipisicing.</p> -->
                            </div>
                            <form action="#" method="post">
                                <div class="form-group first">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username">

                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password">

                                </div>

                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">Remember
                                            me</span>
                                        <input type="checkbox" checked="checked" />
                                        <div style="background-color: purple;" class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto"><a href="{{ route('forgotpas')}}" class="forgot-pass">Forgot Password</a></span>
                                </div>
                                <!-- button -->
                                <input type="submit" style="background-color: purple;border:1px solid purple;height: 45px;" value="Log In" class="btn text-white btn-block btn-primary">
                                <hr>

                                <div style="display:flex; justify-content:center ;" class="social-login mt-4">
                                    <a href="#" class="facebook">
                                        <span class="icon-facebook mr-3"></span>
                                    </a>
                                    <a href="#" class="twitter" style="margin:0px 10px 0px 10px">
                                        <span class="icon-twitter mr-3"></span>
                                    </a>
                                    <a href="#" class="google">
                                        <span class="icon-google mr-3"></span>
                                    </a>
                                </div>
                            </form>
                            <a class="btn text-white btn-block btn-primary" href="{{ route('signup')}}" style="text-decoration: none;background-color: purple;border:1px solid purple;width: 150px;margin: 0 auto;height: 45px;">Sign Up<a />
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
<footer class="" style="background-color: #333333;">

    <div style="display: flex;justify-content: center;">
        <div class="footer-left">

            <img style="margin: 20px 0 0 40px ;" width="150px" height="130px" src="/images/logo.png" alt="">

            <p class="" style="color:white">Copyright © Công ty TNHH T4TeK</p>
        </div>

        <div class="" style="color:white;margin: 30px 70px 0 70px;">
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
                <div style="margin:30px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="/images/fb.png" alt="">
                </div>
            </a>
            <a href="http://zalo.me/518410350895218680?src=qr">
                <div style="margin:30px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="https://cdn.haitrieu.com/wp-content/uploads/2022/01/Logo-Zalo-Arc.png" alt="">
                </div>
            </a>
            <a href="">
                <div style="margin:30px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Instagram_logo_2016.svg/2048px-Instagram_logo_2016.svg.png" alt="">
                </div>
            </a>
            <a href="">
                <div style="margin:30px 10px 0 0;">
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="/images/link.png" alt="">
                </div>
            </a>
        </div>
    </div>

</footer>

</html>