    
    <header>
        <!-- End headerbox-->
        <div class="headerbox">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col">
                        <div class="logo">
                            <a href="{{ url('/') }}" title="Volver a inicio">
                                <img src="{{ asset('img/frontend_img/logo.png') }}" alt="Logo" class="logo_img">
                            </a>
                        </div>
                    </div>
                    <div class="col">
                        <a class="mobile-nav" href="#mobile-nav"><i class="fa fa-bars"></i></a>
                    </div>
                
                    <div class="col-sm-12 col-md-6 col-md-offset-6">
                        @foreach(App\Tournament::where('active', true)->get()[0]->clubs as $club)
                                <img style="width: 40px; height:auto"src="{{ asset('storage/'.$club->image->path) }}" alt="" class="shields">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- End headerbox-->
    </header>