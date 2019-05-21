    <nav class="mainmenu">
            <div class="container">
                <!-- Menu-->
                <ul class="sf-menu" id="menu">
                    <li>
                        <a href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li>
                        <a href="{{ url('/web/board') }}">Comisión Directiva</a>
                    </li>

                    <li><a href="{{ url('/web/partners') }}">Afiliados y Socios</a></li>
                    <li><a href="{{ url('/web/galery') }}">Galería de Imágenes</a></li>
                    <li><a href="{{ url('/web/teams') }}">Equipos</a></li>
                    <li class="current">
                        <a href="">Torneos</a>
                        <ul class="sub-current">
                            @foreach($tournaments as $tournament)
                                <li>
                                    <a href="{{ url('/web/tournament/'.$tournament->id) }}">{{ $tournament->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    
                    <li><a href="{{ url('/web/fixtures') }}">Fixture</a></li>
                    <!--{{--<li><a href="{{ url('/web/categories') }}">Categorías</a></li>--}}-->
                    <li><a href="{{ url('/web/regulation') }}">Reglamento</a></li>
                    <li><a href="{{ url('/web/contact') }}">Contacto</a></li>
                    <li><a href="https://www.dropbox.com/s/2rce5yq7rmf51nd/Lista_de_buena_fe.pdf?dl=0">Lista de buena fe<i class="cloud-download-alt"></i></a></li>
                    <li><a href="{{ url('/user') }}"><i class="fa fa-sign-in"></i></a></li>
                </ul>
                <!-- End Menu-->
            </div>
    </nav>
