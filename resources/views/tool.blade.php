<!DOCTYPE html>
<html style="font-size: 16px;" lang="en">

<head>
    <link rel="icon" href="/assets/icons/icon.png" type="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <meta name="keywords" content="INTUITIVE">
    <meta name="description" content="">
    <title>PDFTools</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="/assets/fonts/icomoon/style.css">
    <link rel="stylesheet" href="/assets/css/owl.carousel.min.css"> -->
    <!-- Latest compiled and minified CSS -->

    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">


    <!--===============================================================================================-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>


    
    <!--===============================================================================================-->

    <!-- end swal js -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <!-- Style -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="/assets/css/Page-1.css" media="screen">
    <script class="u-script" type="text/javascript" src="/assets/js/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="/assets/js/nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 5.5.0, nicepage.com">
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">


    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "",
            "logo": "images/logo.png",
            "sameAs": []
        }
    </script>
    <style>
        /* #drop-area {
            margin: 10px !important;
        } */
    </style>
    <meta name="theme-color" content="#478ac9">
    <meta property="og:title" content="PDFTools">
    <meta property="og:type" content="website">
    <meta data-intl-tel-input-cdn-path="intlTelInput/">
</head>

<body class="u-body u-xl-mode" data-lang="en" style="margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column; background: linear-gradient(to bottom, #ECF2FF, #BFACE2);background-attachment: fixed;">
    <div style="flex-grow: 1;">
        <header style="background-color: #404040;" class="u-clearfix u-header u-sticky u-sticky-a44c u-header" id="sec-e290">
            <div class="u-clearfix u-sheet u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-sheet-1">
                <a href="{{route('convert')}}" class="u-enable-responsive u-image u-logo u-image-1" data-image-width="200" data-image-height="200">
                    <img src="/assets/images/logo_edit.png" class="u-logo-image u-logo-image-1">
                </a>
                <nav class="u-align-left-lg u-align-left-xl u-menu u-menu-one-level u-offcanvas u-menu-1" data-responsive-from="MD">
                    <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
                        <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="#">
                            <svg class="u-svg-link" viewBox="0 0 24 24">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-50cf"></use>
                            </svg>
                            <svg class="u-svg-content" version="1.1" id="svg-50cf" viewBox="0 0 16 16" x="0px" y="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <rect y="1" width="16" height="2"></rect>
                                    <rect y="7" width="16" height="2"></rect>
                                    <rect y="13" width="16" height="2"></rect>
                                </g>
                            </svg>
                        </a>
                    </div>
                    <div class="u-custom-menu u-nav-container" style="color:white">
                        <ul class="u-nav u-unstyled u-nav-1">
                            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="{{route('convert')}}" style="padding: 10px 16px;">@lang('lang.home')</a>
                            </li>
                            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="{{route('aboutus')}}" style="padding: 10px 16px;">{{trans('lang.about')}}</a>
                            </li>
                            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="{{route('contact')}}" style="padding: 10px 16px;">{{trans('lang.contact')}}</a>
                            </li>
                            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="" style="padding: 10px 16px;">{{trans('lang.blog')}}</a>
                            </li>
                            <style>
                                /* The switch - the box around the slider */
                                .switch {
                                    font-size: 17px;
                                    position: relative;
                                    display: inline-block;
                                    width: 3.5em;
                                    height: 2em;
                                }

                                /* Hide default HTML checkbox */
                                .switch input {
                                    opacity: 0;
                                    width: 0;
                                    height: 0;
                                }

                                /* The slider */
                                .slider {
                                    position: absolute;
                                    cursor: pointer;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background-color: rgb(0, 0, 0);
                                    transition: .4s;
                                    border-radius: 30px;
                                }

                                .slider:before {
                                    position: absolute;
                                    content: "";
                                    height: 1.4em;
                                    width: 1.4em;
                                    border-radius: 20px;
                                    left: 0.3em;
                                    bottom: 0.3em;
                                    background-color: rgb(219, 198, 2);
                                    transition: .4s;
                                }

                                input:checked+.slider {
                                    background-color: #000000;
                                }

                                input:focus+.slider {
                                    box-shadow: 0 0 1px #000000;
                                }

                                input:checked+.slider:before {
                                    transform: translateX(1.5em);
                                }

                                .slider::after {
                                    width: 20px;
                                    height: 20px;
                                    left: 20%;
                                    top: 10%;
                                    border-radius: 50%;
                                    position: absolute;
                                    content: "";
                                    background-color: rgb(0, 0, 0);
                                    transition: ease 0.4s;
                                }

                                input:checked+.slider::after {
                                    left: 80%;
                                    width: 0px;
                                    height: 0px;
                                }
                            </style>
                            <li class="u-nav-item">
                                <div class="dropdown">
                                    <a style="background-color: #404040;" class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-solid fa-earth-americas"></i>
                                        {{trans('lang.eng')}}
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="{{url('language/en')}}">English</a></li>
                                        <li><a class="dropdown-item" href="{{url('language/vi')}}">Tiếng việt</a></li>
                                    </ul>
                                </div>
                                <!-- <a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="blog/blog.html" style="padding: 10px 16px;"></a> -->
                            </li>
                        </ul>
                    </div>
                    <div class="u-custom-menu u-nav-container-collapse">
                        <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
                            <div class="u-inner-container-layout u-sidenav-overflow">
                                <div class="u-menu-close"></div>
                                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2" style="color:white">
                                    <li class="u-nav-item"><a class="u-button-style u-nav-link" href="{{route('convert')}}">@lang('lang.home')</a>
                                    </li>
                                    <li class="u-nav-item"><a class="u-button-style u-nav-link" href="{{route('aboutus')}}">{{trans('lang.about')}}</a>
                                    </li>
                                    <li class="u-nav-item"><a class="u-button-style u-nav-link" href="{{route('contact')}}">{{trans('lang.contact')}}</a>
                                    </li>
                                    <li class="u-nav-item"><a class="u-button-style u-nav-link" href="">{{trans('lang.blog')}}</a>
                                    </li>
                                    <li class="u-nav-item">
                                        <div class="dropdown">
                                            <a style="background-color: #404040;" class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa-solid fa-earth-americas"></i>
                                                {{trans('lang.eng')}}
                                            </a>

                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{url('language/en')}}">English</a></li>
                                                <li><a class="dropdown-item" href="{{url('language/vi')}}">Tiếng việt</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
                    </div>
                </nav>
                <nav class="u-menu u-menu-one-level u-offcanvas u-menu-2" data-responsive-from="MD">
                    <div class="menu-collapse" style="font-size: 1rem; letter-spacing: 0px;">
                        <a class="u-button-style u-custom-left-right-menu-spacing u-custom-padding-bottom u-custom-top-bottom-menu-spacing u-file-icon u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base u-file-icon-1" href="#">
                            <img src="/assets/images/456212.png" alt="">
                        </a>
                    </div>
                    <div class="u-custom-menu u-nav-container">
                        <ul class="u-nav u-unstyled u-nav-3" style="color:white">
                           <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base
                            " href="/login" >Profile</a>
                            </li>
                            <li class="u-nav-item"><a class="u-button-style u-nav-link u-text-active-palette-1-base u-text-hover-palette-2-base" href="/logout" >LogOut</a>
                            </li> 
                        </ul>
                    </div>
                    <div class="u-custom-menu u-nav-container-collapse">
                        <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
                            <div class="u-inner-container-layout u-sidenav-overflow">
                                <div class="u-menu-close"></div>
                                <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-4" style="color:white">
                                    <!-- <li class="u-nav-item"><a class="u-button-style u-nav-link" href="Home.html">Profile</a>
                                    </li>
                                    <li class="u-nav-item"><a class="u-button-style u-nav-link" href="About.html">LogOut</a>
                                    </li> -->
                                    <li class="u-nav-item">
                                        <label class="switch">
                                            <input type="checkbox">
                                            <span class="slider"></span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
                    </div>
                </nav>
            </div>
            <style class="u-sticky-style" data-style-id="a44c">
                .u-sticky-fixed.u-sticky-a44c,
                .u-body.u-sticky-fixed .u-sticky-a44c {
                    box-shadow: 2px 2px 8px 0px rgba(128, 128, 128, 1) !important
                }

                .u-sticky-fixed.u-sticky-a44c:before,
                .u-body.u-sticky-fixed .u-sticky-a44c:before {
                    borders: top right bottom left !important;
                    border-color: #404040 !important;
                    border-width: 2px !important
                }
            </style>
        </header>
        
        @yield('body')
    </div>
    <script src="/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <footer class="u-align-center u-clearfix u-footer u-grey-80 u-footer" id="sec-7c63" style="">
        <div class="u-clearfix u-sheet u-sheet-1">
            <div class="u-clearfix u-expanded-width u-layout-wrap u-layout-wrap-1">
                <div class="u-layout">
                    <div class="u-layout-row">
                        <div class="u-container-style u-layout-cell u-size-27 u-layout-cell-1">
                            <div class="u-container-layout u-container-layout-1">
                                <img class="u-image u-image-contain u-image-default u-preserve-proportions u-image-1" src="" alt="" data-image-width="200" data-image-height="200">
                                <p class="u-text u-text-default u-text-1"> Copyright © Bootstrap</p>
                                <div class="u-social-icons u-spacing-10 u-social-icons-1">
                                    <a class="u-social-url" title="facebook" target="_blank" href="https://facebook.com/name"><span class="u-icon u-social-facebook u-social-icon u-icon-1"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style="">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-fb79"></use>
                                            </svg><svg class="u-svg-content" viewBox="0 0 112 112" x="0" y="0" id="svg-fb79">
                                                <circle fill="currentColor" cx="56.1" cy="56.1" r="55"></circle>
                                                <path fill="#FFFFFF" d="M73.5,31.6h-9.1c-1.4,0-3.6,0.8-3.6,3.9v8.5h12.6L72,58.3H60.8v40.8H43.9V58.3h-8V43.9h8v-9.2
c0-6.7,3.1-17,17-17h12.5v13.9H73.5z"></path>
                                            </svg></span>
                                    </a>
                                    <a class="u-social-url" title="twitter" target="_blank" href="https://twitter.com/name"><span class="u-icon u-social-icon u-social-twitter u-icon-2"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style="">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-8738"></use>
                                            </svg><svg class="u-svg-content" viewBox="0 0 112 112" x="0" y="0" id="svg-8738">
                                                <circle fill="currentColor" class="st0" cx="56.1" cy="56.1" r="55"></circle>
                                                <path fill="#FFFFFF" d="M83.8,47.3c0,0.6,0,1.2,0,1.7c0,17.7-13.5,38.2-38.2,38.2C38,87.2,31,85,25,81.2c1,0.1,2.1,0.2,3.2,0.2
c6.3,0,12.1-2.1,16.7-5.7c-5.9-0.1-10.8-4-12.5-9.3c0.8,0.2,1.7,0.2,2.5,0.2c1.2,0,2.4-0.2,3.5-0.5c-6.1-1.2-10.8-6.7-10.8-13.1
c0-0.1,0-0.1,0-0.2c1.8,1,3.9,1.6,6.1,1.7c-3.6-2.4-6-6.5-6-11.2c0-2.5,0.7-4.8,1.8-6.7c6.6,8.1,16.5,13.5,27.6,14
c-0.2-1-0.3-2-0.3-3.1c0-7.4,6-13.4,13.4-13.4c3.9,0,7.3,1.6,9.8,4.2c3.1-0.6,5.9-1.7,8.5-3.3c-1,3.1-3.1,5.8-5.9,7.4
c2.7-0.3,5.3-1,7.7-2.1C88.7,43,86.4,45.4,83.8,47.3z"></path>
                                            </svg></span>
                                    </a>
                                    <a class="u-social-url" title="instagram" target="_blank" href="https://instagram.com/name"><span class="u-icon u-social-icon u-social-instagram u-icon-3"><svg class="u-svg-link" preserveAspectRatio="xMidYMin slice" viewBox="0 0 112 112" style="">
                                                <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-de8f"></use>
                                            </svg><svg class="u-svg-content" viewBox="0 0 112 112" x="0" y="0" id="svg-de8f">
                                                <circle fill="currentColor" cx="56.1" cy="56.1" r="55"></circle>
                                                <path fill="#FFFFFF" d="M55.9,38.2c-9.9,0-17.9,8-17.9,17.9C38,66,46,74,55.9,74c9.9,0,17.9-8,17.9-17.9C73.8,46.2,65.8,38.2,55.9,38.2
z M55.9,66.4c-5.7,0-10.3-4.6-10.3-10.3c-0.1-5.7,4.6-10.3,10.3-10.3c5.7,0,10.3,4.6,10.3,10.3C66.2,61.8,61.6,66.4,55.9,66.4z"></path>
                                                <path fill="#FFFFFF" d="M74.3,33.5c-2.3,0-4.2,1.9-4.2,4.2s1.9,4.2,4.2,4.2s4.2-1.9,4.2-4.2S76.6,33.5,74.3,33.5z"></path>
                                                <path fill="#FFFFFF" d="M73.1,21.3H38.6c-9.7,0-17.5,7.9-17.5,17.5v34.5c0,9.7,7.9,17.6,17.5,17.6h34.5c9.7,0,17.5-7.9,17.5-17.5V38.8
C90.6,29.1,82.7,21.3,73.1,21.3z M83,73.3c0,5.5-4.5,9.9-9.9,9.9H38.6c-5.5,0-9.9-4.5-9.9-9.9V38.8c0-5.5,4.5-9.9,9.9-9.9h34.5
c5.5,0,9.9,4.5,9.9,9.9V73.3z"></path>
                                            </svg></span>
                                    </a>
                                    <a class="u-social-url" target="_blank" data-type="Github" title="Github" href=""><span class="u-file-icon u-icon u-social-github u-social-icon u-icon-4"><img src="/assets/images/zalo-cir.png" alt=""></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="u-container-style u-layout-cell u-size-33 u-layout-cell-2">
                            <div class="u-container-layout u-container-layout-2">
                                <p class="u-text u-text-2"><span class="u-icon"><svg class="u-svg-content" viewBox="0 0 54.757 54.757" x="0px" y="0px" style="width: 1em; height: 1em;">
                                            <path d="M40.94,5.617C37.318,1.995,32.502,0,27.38,0c-5.123,0-9.938,1.995-13.56,5.617c-6.703,6.702-7.536,19.312-1.804,26.952
	L27.38,54.757L42.721,32.6C48.476,24.929,47.643,12.319,40.94,5.617z M27.557,26c-3.859,0-7-3.141-7-7s3.141-7,7-7s7,3.141,7,7
	S31.416,26,27.557,26z"></path>
                                        </svg><img></span> Head of Office: {{trans('lang.add')}}
                                </p>
                                <p class="u-text u-text-3"><span class="u-icon"><svg class="u-svg-content" viewBox="0 0 54.757 54.757" x="0px" y="0px" style="width: 1em; height: 1em;">
                                            <path d="M40.94,5.617C37.318,1.995,32.502,0,27.38,0c-5.123,0-9.938,1.995-13.56,5.617c-6.703,6.702-7.536,19.312-1.804,26.952
	L27.38,54.757L42.721,32.6C48.476,24.929,47.643,12.319,40.94,5.617z M27.557,26c-3.859,0-7-3.141-7-7s3.141-7,7-7s7,3.141,7,7
	S31.416,26,27.557,26z"></path>
                                        </svg><img></span> R&amp;D Center: {{trans('lang.add2')}}
                                </p>
                                <p class="u-text u-text-4"><a href="{{route('term')}}">{{trans('lang.dieukhoan')}}</a></p>
                                <p class="u-text u-text-5"><a href="{{route('policy')}}">{{trans('lang.quyen')}}</a></p>
                                <p style="visibility: hidden;" class="u-text u-text-6"><a href="">lorem</a></p>
                                <p class="u-align-left-xl u-text u-text-7"><a href="{{route('contact')}}">{{trans('lang.contact')}}</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>