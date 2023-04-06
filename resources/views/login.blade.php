@extends('tool')
@section('body')
<section class="u-clearfix u-section-1" id="sec-e85a">
    <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-sm u-valign-middle-xs u-sheet-1">
        <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
            <div class="u-layout">
                <div class="u-layout-row shadow">
                    <div class=" u-container-style u-layout-cell u-shape-rectangle u-size-37 u-layout-cell-2">
                        <div style="width: 80%;margin: 0 auto;padding-top: 20px;margin-top: 20px;">
                            <h2>Sign In</h2>
                            <form action="" method="post">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name= "username" id="oldpass" placeholder="Name">
                                    <label for="name">Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control"name= "password"id="newpass" placeholder="Phone">
                                    <label for="phone">Password</label>
                                </div>
                                <input type="submit" style="margin:20px 0 20px 0;background-color: #00235B;height: 45px;width: 100%;" value="Login" class="btn text-white btn-block btn-primary">
                                <p>No account? <a href="{{ route('signup')}}">Create one!</a></p>
                                <hr>
                                <div style="display:flex; justify-content:center;" class="social-login mt-4">
                                    <a href="#" class="facebook" style="padding-top:12px;">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="twitter" style="margin:0px 10px 0px 10px;padding-top:12px;">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                    <a href="#" class="google" style="padding-top:12px;">
                                        <i class="fa-brands fa-google"></i>
                                    </a>
                                </div>
                                <p style="text-align: center;">Need you find <a href="{{ route('forgotpas')}}">your password?</a></p>
                            </form>
                        </div>
                    </div>
                    <div class="u-align-center-md u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-shape-rectangle u-size-23 u-layout-cell-1">
                        <img class="u-expanded-width-md u-image u-image-default u-image-1" width="420px" height="250px" style="border-radius: 10px;height: 522px !important" src="/assets/images/log_in.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection