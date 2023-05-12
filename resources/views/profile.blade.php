@extends('tool')
@section('body')
<section class="u-clearfix u-section-1" id="sec-e85a">
    <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-sm u-valign-middle-xs u-sheet-1">
        <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
            <div class="u-layout" style="margin-top: 30px;">
                <!-- <div style="text-align: center;">
                    <img style="margin:10px 0 0 0;object-fit: contain;max-width: 100%;" src="/assets/images/contact.png" alt="">
                </div> -->
                <div class="u-layout-row shadow">
                    <div class=" u-container-style u-layout-cell u-shape-rectangle u-size-17 u-layout-cell-2">
                        <div class="rounded shadow-sm flex-shrink-2 p-4 align-self-start" style="background-color:white;margin: 0 auto;">
                            <div class="text-center">
                                <img src="/assets/images/a.svg" alt="" class="border rounded-circle" style="width:10em;height:10em">
                            </div>
                            <div class="fs-3 fw-bold mt-3 mb-2 text-center">Your Name</div>
                            <hr>
                            <div class="align-items-center mb-1">
                                <p>YourMail@gmail.com</p>
                            </div>
                            <div class="text-center mt-2">
                                <a href="{{ route('change_pass') }}" style="width: 100%;" class="btn btn-light btn-sm fw-semibold">Change Password</a>
                            </div>
                        </div>

                    </div>
                    <div class="u-align-center-md u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-shape-rectangle u-size-43 u-layout-cell-1">
                        <div class="rounded" style="background-color:white;width: 80%;margin: 0 auto;margin-top: 50px;">
                            <!-- key -->
                            <form action="#" method="post">
                                <div class="form-group first">
                                    <!-- <label for="username">Key</label> -->
                                    <input type="text" class="form-control" id="username" disabled>
                                </div>
                                <!-- button -->
                                <input type="submit" style="background-color: #00235B;border:1px solid purple;height: 45px;width: 100%;margin-top: 10px;" value="Get Key" class="btn text-white btn-block btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection