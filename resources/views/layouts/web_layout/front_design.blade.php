<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic -->
        <meta charset="utf-8">
        <title>Asociación Riojana de Baby Fútbol Infantil</title>
        <meta name="keywords" content="HTML5 Template" />
        <meta name="description" content="Asociación Riojana de Baby Fútbol Infantil">
        <meta name="author" content="https://www.workana.com/freelancer/fb03555b7841fa8a58a11560bd9f3e0e">
        
        <!--tab icon-->
        <link rel="icon" type="image/png" href="{{ asset('img/frontend_img/logo-light.png') }}" />
        <!-- link thumbnail -->
        <meta property="og:image" content="{{ asset('img/frontend_img/slide/portada.png') }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="www.babyfutbollarioja.com" />
        <meta property="og:title" content="ARBFI" />
        <meta property="og:description" content="Sitio web de la Asociación Riojana de Baby Fútbol Infantil" />
        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        

    </head>

    <body>
        @include('layouts.web_layout.styles')
        <!-- layout-->
        <div id="layout">
            <!-- Header-->
                @include('layouts.web_layout.header')    
            <!-- End Header-->

            <!-- mainmenu-->
                @include('layouts.web_layout.top_navbar')
            <!-- End mainmenu-->

            <!-- Mobile Nav-->
            @include('layouts.web_layout.mobile_navbar')
            <!-- End Mobile Nav-->

            <!-- Section Title -->
                <div class="section-title" style="background:url({{ asset('img/frontend_img/slide/portada.png') }})">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                
                            </div>
                        </div>
                    </div>
                </div>
            <!-- End Section Title -->

            <!-- Section Area - Content Central -->
                @yield('content')
            <!-- End Section Area -  Content Central -->


            <!-- footer-->
                @include('layouts.web_layout.footer')
            <!-- End footer-->
        </div>
        <!-- End layout-->

        <!-- ======================= JQuery libs =========================== -->
             @include('layouts.web_layout.scripts')
        <!-- ======================= End JQuery libs =========================== -->

    </body>
</html>
