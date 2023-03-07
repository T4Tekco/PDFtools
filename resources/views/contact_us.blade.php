@extends('main')
@section('body')
<div class="content container shadow" style="margin-bottom: 50px; position: relative;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 order-md-2" style="margin-top: 40px;">
                <img src="/assets/images/contact-us.svg" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents" style="padding-left: 50px; ">
                <div style="margin-top: 15%;" class=" row justify-content-center shadow p-3 bg-body rounded">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h3>Contacts Us<strong> </strong></h3>
                        </div>
                        <form action="#" method="post">
                            <div class="form-group last mb-4">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name">

                            </div>
                            <div class="form-group last mb-4">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone">

                            </div>
                            <div class="form-group last mb-4">
                                {{-- <label for="email">Email</label> --}}
                                <input disabled type="email" value="contact@t4tek.co" class="form-control" id="email">
                            </div>
                            <div class="form-group last mb-4">
                                <label for="company">Company</label>
                                <input type="text" class="form-control" id="company">
                            </div>
                            <div class="form-group last mb-4">
                                <label for="sub">Subject</label>
                                <input type="text" class="form-control" id="sub">
                            </div>
                            <div class="form-group last mb-4">
                                <label for="ques">Question</label>
                                <textarea type="text" class="form-control" id="ques"></textarea>
                            </div>
                            <!-- button -->
                            <input type="submit" style="background-color: purple;border:1px solid purple;height: 45px;" value="submit" class="btn text-white btn-block btn-primary">
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