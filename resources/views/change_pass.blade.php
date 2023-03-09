@extends('main')
@section('body')
<div class="content container shadow">
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-2">
                <img src="/assets/images/changepass.svg" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents" style="padding-left: 50px;">
                <div style="margin-top: 15%;" class=" row justify-content-center shadow p-3 bg-body rounded">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h3>Change Password<strong> </strong></h3>
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
                            <input type="submit" style="background-color: purple;border:1px solid purple;height: 45px;" value="Save" class="btn text-white btn-block btn-primary">
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
@endsection