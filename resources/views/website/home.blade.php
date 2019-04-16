@extends('layouts.web_layout.front_design')
@section('content')
<!-- Section Area - Content Central -->
<section class="content-info">

    <!-- Dark Home -->
    <div class="dark-home paddings-50-50">
        <div class="container">
            <div class="row">
                <!-- Club Ranking -->
                <div class="col-lg-4">
                    <div class="club-ranking">
                        <h5><a href="group-list.html">Tabla de Posiciones</a></h5>
                        <div class="info-ranking">
                            <ul>
                                @php( $position = 1 )
                                @foreach($scores as $scoreboard)
                                    <li>
                                        <span class="position">
                                            {{ $position }}
                                        </span>
                                        <a href="single-team.html">
                                            <img src="{{--logo --}}" alt="">
                                            {{ $scoreboard[0] }}
                                        </a>
                                        <span class="points">
                                            {{ $scoreboard[1] }}
                                        </span>
                                    </li>
                                    @php( $position++ )
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Club Ranking -->

                <!-- recent-results -->
                <div class="col-lg-4">
                    <div class="recent-results">
                        <h5><a href="group-list.html">Partidos Recientes</a></h5>
                        <div class="info-results">
                            <ul>
                                @for($i = 0; $i < 3; $i++)
                                    <li>
                                        <span class="head">
                                            {{ $fixture[$i][0] }} (CAT. {{ $fixture[$i][1] }}) <span class="date">{{ $fixture[$i][2] }}</span>
                                        </span>
    
                                        <div class="goals-result">
                                            <a href="single-team.html">
                                                <img src="img/clubs-logos/por.png" alt="">
                                                {{ $fixture[$i][3] }}
                                            </a>
    
                                            <span class="goals">
                                                <b>{{ $fixture[$i][4] }}</b> - <b>{{ $fixture[$i][6] }}</b>
                                            </span>
    
                                            <a href="single-team.html">
                                                <img src="img/clubs-logos/esp.png" alt="">
                                                {{ $fixture[$i][5] }}
                                            </a>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end recent-results -->

                <!-- Fair Play -->
                <div class="col-lg-4">
                    <div class="player-ranking">
                        <h5><a href="group-list.html">Fair Play</a></h5>
                        <div class="info-player">
                            <ul>
                                <li>
                                    <span class="position">
                                        1
                                    </span>
                                    <a href="single-team.html">
                                        <img src="img/players/1.jpg" alt="">
                                        Cristiano R.
                                    </a>
                                    <span class="points">
                                        90
                                    </span>
                                </li>

                                <li>
                                    <span class="position">
                                        2
                                    </span>
                                    <a href="single-team.html">
                                        <img src="img/players/2.jpg" alt="">
                                        Lionel Messi
                                    </a>
                                    <span class="points">
                                        88
                                    </span>
                                </li>

                                <li>
                                    <span class="position">
                                        3
                                    </span>
                                    <a href="single-team.html">
                                        <img src="img/players/3.jpg" alt="">
                                        Neymar
                                    </a>
                                    <span class="points">
                                        86
                                    </span>
                                </li>

                                <li>
                                    <span class="position">
                                        4
                                    </span>
                                    <a href="single-team.html">
                                        <img src="img/players/4.jpg" alt="">
                                        Luis Suárez
                                    </a>
                                    <span class="points">
                                        80
                                    </span>
                                </li>

                                <li>
                                    <span class="position">
                                        5
                                    </span>
                                    <a href="single-team.html">
                                        <img src="img/players/5.jpg" alt="">
                                        Gareth Bale
                                    </a>
                                    <span class="points">
                                        76
                                    </span>
                                </li>

                                <li>
                                    <span class="position">
                                        6
                                    </span>
                                    <a href="single-team.html">
                                        <img src="img/players/6.jpg" alt="">
                                        Sergio Agüero
                                    </a>
                                    <span class="points">
                                        74
                                    </span>
                                </li>

                                <li>
                                    <span class="position">
                                        7
                                    </span>
                                    <a href="single-team.html">
                                        <img src="img/players/2.jpg" alt="">
                                        Jamez R.
                                    </a>
                                    <span class="points">
                                        70
                                    </span>
                                </li>

                                <li>
                                    <span class="position">
                                        8
                                    </span>
                                    <a href="single-team.html">
                                        <img src="img/players/1.jpg" alt="">
                                            Falcao Garcia
                                    </a>
                                    <span class="points">
                                        65
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Top player -->
            </div>
        </div>
    </div>

    {{--
    <!-- Content Central -->
    <div class="container padding-top">
        <div class="row">

            <!-- content Column Left -->
            <div class="col-lg-6 col-xl-7">
                <!-- Recent Post -->
                <div class="panel-box">

                    <div class="titles">
                        <h4>Recent News</h4>
                    </div>

                    <!-- Post Item -->
                    <div class="post-item">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="img-hover">
                                   <img src="img/blog/1.jpg" alt="" class="img-responsive">
                                   <div class="overlay"><a href="single-news.html">+</a></div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5><a href="single-news.html">Group Stage Breakdown</a></h5>
                                <span class="data-info">January 3, 2014  / <i class="fa fa-comments"></i><a href="#">0</a></span>
                                <p>While familiar with fellow European nation France, Hareide admits that South American side Peru.<a href="single-news.html">Read More [+]</a></p>
                            </div>
                       </div>
                    </div>
                     <!-- End Post Item -->

                     <!-- Post Item -->
                    <div class="post-item">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="img-hover">
                                   <img src="img/blog/2.jpg" alt="" class="img-responsive">
                                   <div class="overlay"><a href="single-news.html">+</a></div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5><a href="single-news.html">Russia 2018’s potential classic match-ups</a></h5>
                                <span class="data-info">January 9, 2014  / <i class="fa fa-comments"></i><a href="#">5</a></span>
                                <p>Our goal is very clear, it didn’t change after the draw. We should qualify for the knockout stage.<a href="single-news.html">Read More [+]</a></p>
                            </div>
                       </div>
                    </div>
                     <!-- End Post Item -->

                     <!-- Post Item -->
                    <div class="post-item">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="img-hover">
                                   <img src="img/blog/3.jpg" alt="" class="img-responsive">
                                   <div class="overlay"><a href="single-news.html">+</a></div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5><a href="single-news.html">World Cup rivalries reprised</a></h5>
                                <span class="data-info">January  4, 2014  / <i class="fa fa-comments"></i><a href="#">3</a></span>
                                <p>The outdoor exhibition on Manezhnaya Square comprises 11 figures that symbolise the main sites of interest.<a href="single-news.html">Read More [+]</a></p>
                            </div>
                       </div>
                    </div>
                     <!-- End Post Item -->

                     <!-- Post Item -->
                    <div class="post-item">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="img-hover">
                                   <img src="img/blog/4.jpg" alt="" class="img-responsive">
                                   <div class="overlay"><a href="single-news.html">+</a></div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h5><a href="single-news.html">All set for your trip to Russia?</a></h5>
                                <span class="data-info">January 8, 2014  / <i class="fa fa-comments"></i><a href="#">2</a></span>
                                <p>Colombia play Japan on 19 June at the Mordovia Arena, where the piling and casting operations.<a href="single-news.html">Read More [+]</a></p>
                            </div>
                       </div>
                    </div>
                     <!-- End Post Item -->
                </div>
                <!-- End Recent Post -->

                <!-- Experts -->
                <div class="panel-box">
                    <div class="titles">
                        <h4>Best Players</h4>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
                            <div class="box-info">
                                <a href="single-player.html">
                                    <img src="img/players/1.jpg" alt="" class="img-responsive">
                                </a>
                                <h6 class="entry-title"><a href="single-player.html">Cristiano Ronaldo</a></h6>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
                            <div class="box-info">
                                <a href="single-player.html">
                                    <img src="img/players/2.jpg" alt="" class="img-responsive">
                                </a>
                                <h6 class="entry-title"><a href="single-player.html">Lionel Messi</a></h6>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
                            <div class="box-info">
                                <a href="single-player.html">
                                    <img src="img/players/3.jpg" alt="" class="img-responsive">
                                </a>
                                <h6 class="entry-title"><a href="single-player.html">Neymar</a></h6>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
                            <div class="box-info">
                                <a href="single-player.html">
                                    <img src="img/players/4.jpg" alt="" class="img-responsive">
                                </a>
                                <h6 class="entry-title"><a href="single-player.html">Luis Suárez</a></h6>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
                            <div class="box-info">
                                <a href="single-player.html">
                                    <img src="img/players/5.jpg" alt="" class="img-responsive">
                                </a>
                                <h6 class="entry-title"><a href="single-player.html"> Gareth Bale</a></h6>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 col-md-4 col-lg-4">
                            <div class="box-info">
                                <a href="single-player.html">
                                    <img src="img/players/6.jpg" alt="" class="img-responsive">
                                </a>
                                <h6 class="entry-title"><a href="single-player.html">Sergio Agüero</a></h6>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- End Experts -->
            </div>
             <!-- End content Left -->

            <!-- content Sidebar Center -->
            <aside class="col-sm-6 col-lg-3 col-xl-3">
                <!-- Locations -->
                <div class="panel-box">
                    <div class="titles no-margin">
                        <h4>Locations</h4>
                    </div>
                    <!-- Locations Carousel -->
                    <ul class="single-carousel">
                        <li>
                            <img src="img/locations/1.jpg" alt="" class="img-responsive">
                            <div class="info-single-carousel">
                                <h4>Saint Petersburg</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo cillum dolore eu fugiat nulla  sit amet, consectetur adipisicing elit, pariatur.</p>
                            </div>
                        </li>
                        <li>
                            <img src="img/locations/2.jpg" alt="" class="img-responsive">
                            <div class="info-single-carousel">
                                <h4>Ekaterinburg</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                        </li>
                        <li>
                            <img src="img/locations/3.jpg" alt="" class="img-responsive">
                            <div class="info-single-carousel">
                                <h4>Nizhny Novgorod</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo cillum dolore eu fugiat nulla pariatur.</p>
                            </div>
                        </li>
                    </ul>
                    <!-- Locations Carousel -->
                </div>
                <!-- End Locations -->

                <!-- Video presentation -->
                <div class="panel-box">
                    <div class="titles no-margin">
                        <h4>Presentation</h4>
                    </div>
                    <!-- Locations Video -->
                    <div class="row">
                        <iframe src="https://www.youtube.com/embed/AfOlAUd7u4o" class="video"></iframe>
                        <div class="info-panel">
                            <h4>Rio de Janeiro</h4>
                            <p>Lorem ipsum dolor sit amet, sit amet, consectetur adipisicing elit, elit, incididunt ut labore et dolore magna aliqua sit amet, consectetur adipisicing elit,</p>
                        </div>
                    </div>
                    <!-- End Locations Video -->
                </div>
                <!-- End Video presentation-->

                <!-- Widget img-->
                <div class="panel-box">
                    <div class="titles no-margin">
                        <h4>Widget Image</h4>
                    </div>
                    <img src="img/slide/1.jpg" alt="">
                    <div class="row">
                       <div class="info-panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,  ut sit amet, consectetur adipisicing elit, labore et dolore.</p>
                       </div>
                    </div>
                </div>
                <!-- End Widget img-->
            </aside>
            <!-- End content Sidebar Center -->

            <!-- content Sidebar Right -->
            <aside class="col-sm-6 col-lg-3 col-xl-2">
                <!-- Diary -->
                <div class="panel-box">
                    <div class="titles">
                        <h4><i class="fa fa-calendar"></i>Diary</h4>
                    </div>

                    <!-- List Diary -->
                    <ul class="list-diary">
                        <!-- Item List Diary -->
                        <li>
                            <h6>GROUP A <span>14 JUN 2018 - 18:00</span></h6>
                            <ul class="club-logo">
                                <li>
                                    <img src="img/clubs-logos/rusia.png" alt="">
                                    <span>RUSSIA</span>
                                </li>
                                <li>
                                    <img src="img/clubs-logos/arabia.png" alt="">
                                    <span>SAUDI ARABIA</span>
                                </li>
                            </ul>
                        </li>
                        <!-- End Item List Diary -->

                        <!-- Item List Diary -->
                        <li>
                            <h6>GROUP E <span>22 JUN 2018 - 15:00</span></h6>
                            <ul class="club-logo">
                                <li>
                                    <img src="img/clubs-logos/bra.png" alt="">
                                    <span>BRAZIL</span>
                                </li>
                                <li>
                                    <img src="img/clubs-logos/costa-rica.png" alt="">
                                    <span>COSTA RICA</span>
                                </li>
                            </ul>
                        </li>
                        <!-- End Item List Diary -->

                        <!-- Item List Diary -->
                        <li>
                            <h6>GROUP H <span>19 JUN 2018 - 15:00</span></h6>
                            <ul class="club-logo">
                                <li>
                                    <img src="img/clubs-logos/colombia.png" alt="">
                                    <span>COLOMBIA</span>
                                </li>
                                <li>
                                    <img src="img/clubs-logos/japan.png" alt="">
                                    <span>JAPAN</span>
                                </li>
                            </ul>
                        </li>
                        <!-- End Item List Diary -->

                        <!-- Item List Diary -->
                        <li>
                            <h6>GROUP C <span>16 JUN 2018 - 15:00</span></h6>
                            <ul class="club-logo">
                                <li>
                                    <img src="img/clubs-logos/fra.png" alt="">
                                    <span>FRANCE</span>
                                </li>
                                <li>
                                    <img src="img/clubs-logos/aus.png" alt="">
                                    <span>AUSTRALIA</span>
                                </li>
                            </ul>
                        </li>
                        <!-- End Item List Diary -->
                    </ul>
                    <!-- End List Diary -->
                </div>
                <!-- End Diary -->

                <!-- Adds Sidebar -->
                <div class="panel-box">
                   <div class="titles no-margin">
                        <h4><i class="fa fa-link"></i>Cta</h4>
                    </div>
                    <a href="http://themeforest.net/user/iwthemes/portfolio?ref=iwthemes" target="_blank">
                        <img src="img/adds/sidebar.png" class="img-responsive" alt="">
                    </a>
                </div>
                <!-- End Adds Sidebar -->
            </aside>
            <!-- End content Sidebar Right -->

        </div>
    </div>
    <!-- End Content Central -->
    --}}
</section>
<!-- End Section Area -  Content Central -->
@endsection