@extends('layouts.front_layout.front_design')

@section('content')
    <section class="content-info">

        <!-- Single Team Tabs -->
        <div class="single-team-tabs">
        <div class="container">
                <div class="row">
                    <!-- Left Content - Tabs and Carousel -->
                    <div class="col-xl-12 col-md-12">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs" id="myTab">
                        <li class="active"><a href="#squad" data-toggle="tab">PLANTEL</a></li>
                        <li><a href="#fixtures" data-toggle="tab">FIXTURE</a></li>
                        <li><a href="#results" data-toggle="tab">RESULTADOS</a></li>
                        </ul>
                        <!-- End Nav Tabs -->
                    </div>

                    <div class="col-lg-9 padding-top-mini">
                        <!-- Content Tabs -->
                        <div class="tab-content">
                            <!-- Tab Two - squad -->
                            <div class="tab-pane active" id="squad">
                                <div class="row">

                                    @foreach($team->players as $player)
                                    <div class="col-xl-4 col-lg-6 col-md-6">
                                        <div class="item-player">
                                            <div class="head-player">
                                                <img src="{{ asset('img/frontend_img/players/1.jpg') }}" alt="location-team">
                                                <div class="overlay"><a href="single-player.html">+</a></div>
                                            </div>
                                            <div class="info-player">
                                                <span class="number-player">
                                                    {{ $player->number }}
                                                </span>
                                                <h4>
                                                    {{ $player->last_name.' '.$player->first_name }}
                                                    <span>Delantero</span>
                                                </h4>
                                                <ul>
                                                    <li>
                                                        <strong>CATEGORIA</strong> <span><img src="{{ asset('img/frontend_img/clubs-logos/colombia.png') }}" alt=""> {{ $player->category}} </span
                                                    </li>
                                                    <li><strong>PARTIDOS:</strong> <span>90</span></li>
                                                    <li><strong>EDAD:</strong> <span> {{ $player->birth_date->diffInYears() }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            <!-- End Tab Two - squad -->

                            <!-- Tab Theree - fixtures -->
                            <div class="tab-pane" id="fixtures">

                                <table class="table-striped table-responsive table-hover">
                                    <thead>
                                        <tr>
                                            <th>LOCAL</th>
                                            <th class="text-center">VS</th>
                                            <th>VISITANTE</th>
                                            <th>DETALLES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fixture as $match)
                                            @if($match->local_score == null AND $match->visiting_score == null)
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset('img/frontend_img/clubs-logos/colombia.png') }}" alt="icon">
                                                        <strong>{{ $match->local }}</strong><br>
                                                        <small class="meta-text">TORNEO</small>
                                                    </td>
                                                    <td class="text-center">Vs</td>
                                                    <td>
                                                        <img src="{{ asset('img/frontend_img/clubs-logos/japan.png') }}" alt="icon1">
                                                        <strong>{{ $match->visiting }}</strong><br>
                                                        <small class="meta-text">{{ $match->category }}</small>
                                                    </td>
                                                    <td>
                                                        {{ $match->date }}<br>
                                                        <small class="meta-text">{{ $match->stadium }}</small>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        
                                    </tbody>
                                </table>

                            </div>
                            <!-- End Tab Theree - fixtures -->

                            <!-- Tab Theree - results -->
                            <div class="tab-pane" id="results">
                                <div class="recent-results results-page">
                                    <div class="info-results">
                                        <ul>
                                            @foreach($fixture as $match)
                                                @if($match->local_score != null AND $match->visiting_score != null)
                                                    <li>
                                                        <span class="head">
                                                            {{ $match->local.' vs '.$match->visiting}} <span class="date">{{ date('d-m-Y', strtotime($match->date)) }}</span>
                                                        </span>
    
                                                        <div class="goals-result">
                                                            <a href="{{ url('') }}">
                                                                <img src="{{ asset('img/frontend_img/clubs-logos/por.png') }}" alt="">
                                                                {{ $match->local }}
                                                            </a>
    
                                                            <span class="goals">
                                                                <b>{{ $match->local_score }}</b> - <b>{{ $match->visiting_score }}</b>
                                                                <a href="single-result.html" class="btn theme">Ver más</a>
                                                            </span>
    
                                                            <a href="{{ url('') }}">
                                                                <img src="{{ asset('img/frontend_img/clubs-logos/esp.png') }}" alt="">
                                                                {{ $match->local }}
                                                            </a>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                            </div>
                            </div>
                            <!-- End Tab Theree - results -->

                            <!-- Tab Theree - stats -->
                            <div class="tab-pane" id="stats">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="stats-info">
                                            <ul>
                                                <li>
                                                    Matches Played
                                                    <h3>866</h3>
                                                </li>

                                                <li>
                                                    Wins
                                                    <h3>328</h3>
                                                </li>

                                                <li>
                                                    Losses
                                                    <h3>317</h3>
                                                </li>

                                                <li>
                                                    Goals
                                                    <h3>1,188</h3>
                                                </li>

                                                <li>
                                                    Goals Conceded
                                                    <h3>1,170</h3>
                                                </li>

                                                <li>
                                                    Clean Sheets
                                                    <h3>226</h3>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-xl-4">
                                        <!-- Attack -->
                                        <div class="panel-box">
                                            <div class="titles no-margin">
                                                <h4><i class="fa fa-calendar"></i>Attack</h4>
                                            </div>
                                            <ul class="list-panel">
                                                <li><p>Goals <span>1,188</span></p></li>
                                                <li><p>Goals Per Match <span>1.37</span></p></li>
                                                <li><p>Shots <span>4,621</span></p></li>
                                                <li><p>Shooting Accuracy % <span>32%</span></p></li>
                                                <li><p>Penalties Scored <span>30</span></p></li>
                                                <li><p>Big Chances Created <span>293</span></p></li>
                                                <li><p>Hit Woodwork <span>107</span></p></li>
                                            </ul>
                                        </div>
                                        <!-- End Attack -->
                                    </div>

                                    <div class="col-lg-6 col-xl-4">
                                        <!-- Attack -->
                                        <div class="panel-box">
                                            <div class="titles no-margin">
                                                <h4><i class="fa fa-calendar"></i>Team Play</h4>
                                            </div>
                                            <ul class="list-panel">
                                                <li><p>Passes <span>140,417</span></p></li>
                                                <li><p>Passes Per Match <span>162.14</span></p></li>
                                                <li><p>Pass Accuracy % <span>76%</span></p></li>
                                                <li><p>Crosses <span>8,148</span></p></li>
                                                <li><p>Cross Accuracy % <span>22%</span></p></li>
                                            </ul>
                                        </div>
                                        <!-- End Attack -->
                                    </div>

                                    <div class="col-lg-6 col-xl-4">
                                        <!-- Attack -->
                                        <div class="panel-box">
                                            <div class="titles no-margin">
                                                <h4><i class="fa fa-calendar"></i>Defence</h4>
                                            </div>
                                            <ul class="list-panel">
                                                <li><p>Clean Sheets <span>226</span></p></li>
                                                <li><p>Goals Conceded <span>1,170</span></p></li>
                                                <li><p>Goals Conceded Per Match <span>1.35</span></p></li>
                                                <li><p>Saves <span>392</span></p></li>
                                                <li><p>Tackles <span>7,438</span></p></li>
                                                <li><p>Tackle Success % <span>75%</span></p></li>
                                                <li><p>Blocked Shots <span>1,208</span></p></li>
                                                <li><p>Interceptions <span>5,334</span></p></li>
                                                <li><p>Clearances <span>11,436</span></p></li>
                                                <li><p>Headed Clearance <span>3,710</span></p></li>
                                                <li><p>Aerial Battles/Duels Won <span>25,401</span></p></li>
                                                <li><p>Errors Leading To Goal <span>59</span></p></li>
                                                <li><p>Own Goals <span>27</span></p></li>
                                            </ul>
                                        </div>
                                        <!-- End Attack -->
                                    </div>
                                </div>

                            </div>
                            <!-- End Tab Theree - stats -->
                        </div>
                        <!-- Content Tabs -->
                    </div>

                    <!-- Side info single team-->
                    <div class="col-lg-3 padding-top-mini">
                    <!-- Diary -->
                        <div class="panel-box">
                            <div class="titles">
                                <h4><i class="fa fa-calendar"></i>Calendario</h4>
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
                    </div>
                    <!-- end Side info single team-->

                </div>
            </div>
        </div>
        <!-- Single Team Tabs -->
    </section>
@endsection