@extends('main')
@section('body')
<div style="margin-bottom: 60px;min-width: 1140px;margin-top: 100px;" class="container shadow">
    <div class="d-flex flex-row" style="padding:20px 0 30px 0">

        <div class="mt-3 rounded shadow-sm flex-shrink-2 p-4 align-self-start" style="background-color:white;">
            <div class="text-center">
                <img src="/assets/images/a.svg" alt="" class="border rounded-circle" style="width:10em;height:10em">
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
@endsection