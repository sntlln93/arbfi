<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Basic -->
        <meta charset="utf-8">
        <title>Asociación Riojana de Baby Fútbol Infantil</title>
        <meta name="keywords" content="HTML5 Template" />
        <meta name="description" content="Asociación Riojana de Baby Fútbol Infantil">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
        @include('layouts.web_layout.styles')

    </head>

    <body>
        <!-- layout-->
        <div id="layout">
        
            <!-- Section Area - Content Central -->
            <section class="content-info">
            
            <!-- Content Central -->
                <section class="container">
                    <div class="row">
                        <div class="page-error">
                            <h1>500<i class="material-icons">bug_report</i></h1>
                            <hr class="tall">
                            <p class="lead">Algo salió mal.</p>
                            <a href="{{ url('/') }}" class="btn btn-lg btn-primary">Volvé al inicio</a>
                        </div>
                    </div>
                </section>    
            
            <!-- End footer-->
        </div>
        <!-- End layout-->

        <!-- ======================= JQuery libs =========================== -->
             @include('layouts.web_layout.scripts')
        <!-- ======================= End JQuery libs =========================== -->

    </body>
</html>
