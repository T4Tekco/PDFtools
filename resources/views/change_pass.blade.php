@extends('main')
@section('body')

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



    @endsection