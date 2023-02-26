<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styless.css">
    <title>Login #8</title>
</head>

<body>
    <div style="position: fixed;width: 100%;">
        <nav class="navbar navbar-expand-lg" style="background-color: #7852a9;">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('home')}}">
                    <img width="40px" height="40px" src="/images/logo.png" alt="">
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <i class="fas fa-home"></i>
                            <a style="color: white;" class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a style="color: white;" class="nav-link" href="{{ route('profile')}}">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a style="position: absolute;text-align: start; right: 20px;color:white" class="nav-link" href="{{ route('login')}}">Log Out</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </div>
    <div>
        @yield('body')
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/scriptss.js"></script>
</body>

</html>