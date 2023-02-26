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

    <title>Sign up #8</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-md-2">
                    <img src="images/Sign_up.svg" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center shadow p-3 mb-5 bg-body rounded">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign Up <strong> </strong></h3>
                                <!-- <p class="mb-4">Lorem ipsum dolor sit amet elit. Sapiente sit aut eos consectetur
                                    adipisicing.</p> -->
                            </div>
                            <form action="#" method="post">
                                <div class="form-group first">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username">

                                </div>
                                <div class="form-group last mb-4">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email">

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
                                </div>
                                <!-- button đăng nhập -->
                                <input type="submit" style="background-color: purple;border:1px solid purple;height: 45px;" value="Sign Up" class="btn text-white btn-block btn-primary">
                                <hr>

                            </form>
                            <a class="btn text-white btn-block btn-primary" href="{{route('login')}}" style="text-decoration: none;background-color: purple;border:1px solid purple;width: 150px;margin: 0 auto;height: 45px;">Log In<a />
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

</html>