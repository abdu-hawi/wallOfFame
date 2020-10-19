<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{!! $title ?? (setting()->main_lang=='ar'?setting()->site_name_ar:setting()->site_name_en) !!}</title>

        <link rel="icon" href="{!! Storage::url(setting()->icon) !!}" type="image/x-icon">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="{!! asset('/design/landing/bootstrap.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('/design/landing/landing.css') !!}">
{{--        <link rel="stylesheet" href="{!! asset('/design/landing/slider.css') !!}">--}}
        <link rel="stylesheet" href="{!! asset('/design/plugins/fontawesome-free/css/all.min.css') !!}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
{{--        <script src="{!! asset('/design/plugins/jquery/jquery.js') !!}" type="text/javascript"></script>--}}
{{--        <script src="{!! asset('/design/plugins/bootstrap/js/bootstrap.min.js') !!}" type="text/javascript"></script>--}}

    </head>
    <body>
    {{--heder --}}
    <div class="container-fluid col-12 container-fluid-ah container-ah" id="home">
        <div class="col-md-6 container-fluid-ah dropdown hidden-md hidden-lg">
            <img class="logo-menu img-responsive " src="{!! asset('/design/landing/logo_wof.svg') !!}">
            <img src="{!! asset('/design/landing/landing.svg') !!}" class="img-responsive w-100" alt="landing">
            <div class="navbar-fixed-top">
                <button class="btn btn-light btn-menu dropdown-toggle" type="button" data-toggle="dropdown">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#about">About us</a></li>
                    <li><a href="#our_applicaion">Our application</a></li>
                    <li><a href="#contact">Contact us</a></li>
                    <li class="divider"></li>
                    <li><a href="#">English</a></li>
                    <li><a href="#contact">عربي</a></li>
                </ul>
            </div>
        </div>
        <div class="container col-md-6 mt-md-1 mt-lg-5">
            <img class="col-3 img-responsive center-block hidden-sm hidden-xs" src="{!! asset('/design/landing/logo_wof.svg') !!}">
            <div class="ml-5 mt-lg-5">
                <h1 class="text-bold">Wall of fame</h1>
                <h3 class="text-gold-c">phone application that contain all the models in some cities in Saudi Arabia for booking them, to increase their opportunities and people can reach them easily and also to manage their times.
                    There are two versions of the application one for models and the other one for clients.
                </h3>
            </div>
            <div class=" text-center mt-md-1 mt-lg-5">
                <a href="{!! a_dir() !!}" target="_blank" title="google" class="btn mr-3">
                    <img src="{!! asset('/design/landing/googleStore.svg') !!}">
                </a>

                <a href="" target="_blank" title="apple" class="btn">
                    <img src="{!! asset('/design/landing/appleStore.svg') !!}">
                </a>
            </div>
        </div>
        {{--todo: show in top --}}
        <div class="col-md-6 container-fluid-ah dropdown hidden-sm hidden-xs">
            <img src="{!! asset('/design/landing/landing.svg') !!}" class="img-responsive w-100" alt="landing">
            <div class="navbar-fixed-top">
                <button class="btn btn-light btn-menu dropdown-toggle" type="button" data-toggle="dropdown">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#about">About us</a></li>
                    <li><a href="#our_applicaion">Our application</a></li>
                    <li><a href="#contact">Contact us</a></li>
                    <li class="divider"></li>
                    <li><a href="#">English</a></li>
                    <li><a href="#contact">عربي</a></li>
                </ul>
            </div>
        </div>
    </div>
    <br>
    {{-- about --}}
    <div class="container text-center col-md-10 col-md-offset-1" id="about">
        <h1 class="text-center text-bold">About us</h1>
        <h3 class="text-center text-gold-c">
            We are wall of fame application specialized for online booking for models.
            Only wall of fame gives you this opportunity to save your time and to reach for many more models around you by using this application.
        </h3>
        <div class="col-md-5 mt-md-2">
            <h1 class="text-center text-bold text-gold-c">
                Goals
            </h1>
            <h3>
                To be part of 2030 vision by building better environment to communicate with huge number of models easily.
            </h3>
        </div>
        <div class="col-md-5 col-md-offset-2 mt-md-2">
            <h1 class="text-center text-bold text-gold-c">
                Vision
            </h1>
            <h3>
                To be the best and biggest platform that collect famous people and clients together.
            </h3>
        </div>
    </div>

    <br>

{{--     Our application--}}
    <div class="container text-center col-md-10 col-md-offset-1">
    </div>
    <div class="container"></div>

    <div class="container-fluid-ah" id="our_applicaion">
        <h1 class="text-center text-bold text-gold-c">Our application</h1>
        <section id="aboutprocess">
            <div class="container">
                <div class="row">

                    <div class="col-12">
                            <img src="{!! asset('/design/landing/ourApplication.png') !!}" class="img-responsive">
                    </div>
                </div>
                <!--end row -->
            </div>

            <div class=" text-center" style="margin-top: 3%; padding-bottom: 3%;">
                <a href="{!! a_dir() !!}" target="_blank" title="google" class="btn btn-secondary mr-3">
                    <img src="{!! asset('/design/landing/googleStoreLight.svg') !!}" class="border rounded shadow-sm">
                </a>

                <a href="" target="_blank" title="apple">
                    <img src="{!! asset('/design/landing/appleStoreLight.svg') !!}" class="border rounded shadow-sm">
                </a>
            </div>
            <!--end container-->
        </section>
    </div>

    <div class="container-fluid-ah footer" id="contact">
        <div class="text-center" style="padding-top: 3rem;">
            2020 All rights reserved | This template is made with <i class="fa fa-heart text-white" aria-hidden="true"></i> By Abdu Hawi Developer
        </div>
    </div>


    </body>
</html>
{{--
<section id="aboutprocess">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class="text-center">Our agile team continuously delivers working software and empowers your organization to embrace changing requirements.
                    </p>
                    <button type="button" class="btn btn-link center-block white" role="link" type="submit" name="op" value="Link 2">about our process</button>
                </div>
                <!--end col-md-8 col-md-offset-2-->
            </div>
            <!--end row -->
        </div>
        <!--end container-->
    </section>

--}}
