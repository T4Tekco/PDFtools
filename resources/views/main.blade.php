<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <link rel="icon" href="/assets/icons/icon.png" type="">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <title>Convert Files</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top" style="background-color: #333333;">
        <div class="container-fluid" style="margin: 0 0 0 167px;">
            <a class="navbar-brand" href="{{route('convert')}}">
                <img width="150px" height="50px" src="/assets/images/background.png" alt="">
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link active" aria-current="page" href="{{route('convert')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="{{ route('profile')}}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a style="position: absolute;text-align: start; right: 192px;color:white" class="nav-link" href="{{ route('login')}}">Log Out</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="{{ route('contact')}}">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a style="color: white;" class="nav-link" href="{{ route('aboutus')}}">About Us</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    @yield('body')
</body>

<footer class="" style="background-color: #333333;">

    <div style="display: flex;justify-content: center;">
        <div class="footer-left">

            <img style="margin: 20px 0 0 40px ;" width="150px" height="130px" src="/assets/images/logo.png" alt="">

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
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="/assets/images/fb.png" alt="">
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
                    <img style="width: 50px;height: 50px;" class=" rounded-circle" src="/assets//images/link.png" alt="">
                </div>
            </a>
        </div>
    </div>

</footer>
<script src="/assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/js/popper.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/main.js"></script>

</html>