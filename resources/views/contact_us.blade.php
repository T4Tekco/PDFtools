@extends('tool')
@section('body')
<section class="u-clearfix u-section-1" id="sec-e85a">
    <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-sm u-valign-middle-xs u-sheet-1">
        <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
            <div class="u-layout">
                <div style="text-align: center;">
                    <img style="margin:10px 0 0 0;object-fit: contain;max-width: 100%;" src="/assets/images/contact.png" alt="">
                </div>
                <div class="u-layout-row shadow">
                    <div class=" u-container-style u-layout-cell u-shape-rectangle u-size-37 u-layout-cell-2">
                        <div style="width: 80%;margin: 0 auto;padding-top: 20px;">
                            <form action="" method="post">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="name" placeholder="Name">
                                    <label for="name">Name</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="phone" placeholder="Phone">
                                    <label for="phone">Phone</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="mail" placeholder="Your Email">
                                    <label for="mail">Your Email</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="comp" placeholder="Company">
                                    <label for="comp">Company</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="sub" placeholder="Subject">
                                    <label for="sub">Subject</label>
                                </div>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Question</label>
                                </div>
                                <input type="submit" style="margin:20px 0 20px 0;background-color: #407BFF;height: 45px;width: 100%;" value="submit" class="btn text-white btn-block btn-primary">
                            </form>
                        </div>
                    </div>
                    <div class="u-align-center-md u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-shape-rectangle u-size-23 u-layout-cell-1">
                        <img class="u-expanded-width-md u-image u-image-default u-image-1" width="420px" height="250px" style="border-radius: 10px;height: 522px !important" src="/assets/images/contact-us2.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection