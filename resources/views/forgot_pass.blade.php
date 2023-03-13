@extends('tool')
@section('body')
<section class="u-clearfix u-section-1" id="sec-e85a">
    <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-sm u-valign-middle-xs u-sheet-1">
        <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
            <div class="u-layout">
                <div class="u-layout-row shadow">
                    <div class=" u-container-style u-layout-cell u-shape-rectangle u-size-37 u-layout-cell-2">
                        <div style="width: 80%;margin: 0 auto;padding-top: 20px;margin-top: 20px;">
                            <h2>Forgot Password</h2>
                            <form action="" method="post">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="oldpass" placeholder="email">
                                    <label for="email">Email</label>
                                </div>
                                <input type="submit" style="margin:20px 0 20px 0;background-color: #00235B;height: 45px;width: 100%;" value="Reset Password" class="btn text-white btn-block btn-primary">
                            </form>
                        </div>
                    </div>
                    <div class="u-align-center-md u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-shape-rectangle u-size-23 u-layout-cell-1">
                        <img class="u-expanded-width-md u-image u-image-default u-image-1" width="420px" height="250px" style="border-radius: 10px;height: 423px !important" src="/assets/images/forgotpass.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection