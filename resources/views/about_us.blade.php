@extends('tool')
@section('body')
<section class="u-clearfix u-section-1" id="sec-e85a" >
    <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-sm u-valign-middle-xs u-sheet-1">
        <div class="u-clearfix u-expanded-width u-gutter-0 u-layout-wrap u-layout-wrap-1">
            <div class="u-layout">
                <div style="text-align: center;">
                    <img style="margin:10px 0 0 0;object-fit: cover;max-width: 100%;" src="/assets/images/about-us.svg" alt="">
                </div>
                <div class="u-layout-row shadow">

                    <div class="u-align-center-md u-align-center-sm u-align-center-xs u-container-style u-layout-cell u-shape-rectangle u-size-23 u-layout-cell-1">
                        <img class="u-expanded-width-md u-image u-image-default u-image-1" width="420px" height="250px" style="margin-bottom: 10px; border-radius: 10px;" src="" alt="anh">
                    </div>
                    <div class=" u-container-style u-layout-cell u-shape-rectangle u-size-37 u-layout-cell-2">
                        <p style="color:black;font-size: 18px;user-select: none;padding-left: 10px;"> {{trans('lang.about1')}}
                            <br>
                            <br>
                            {{trans('lang.about2')}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection