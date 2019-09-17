@extends('layouts.web_layout.front_design')

@section('content')

    <section class="content-info">

        <!-- Single Team Tabs -->
        <div class="single-player-tabs">
        <div class="container">
                <div class="row">
                    <!-- Side info single team-->
                    <div class="col-lg-4 col-xl-3">

                        <div class="item-player single-player">
                            <div class="head-player">
                                <img src="{{ asset('storage/'.$player->image->path) }}" alt="location-team">
                            </div>
                            <div class="info-player">
                                <span class="number-player">
                                    <img src="{{ asset('storage/'.$player->team->logo) }}" alt="">
                                </span>

                                <h4>
                                    {{ $player->first_name.' '.$player->last_name }}
                                    <span>{{ $player->position }}</span>
                                </h4>
                                <ul>
                                    <li>
                                        <strong>Club</strong> <span> {{ $player->team->club->name }} </span>
                                    </li>
                                    <li><strong>Fecha de nacimiento:</strong> <span>{{ $player->birth_date->format('d/m/Y') }}</span></li>
                                    <li><strong>DNI:</strong> <span>{{ $player->dni }}</span></li>
                                    <li><strong>Categoría:</strong> <span>{{ $player->team->category->name }}</span></li>
                                </ul>

                            </div>
                        </div>

                        
                    </div>
                    <!-- end Side info single team-->

                    <div class="col-lg-8 col-xl-9">

                        <!-- Content Tabs -->
                        <div class="content-info">
                            <!-- Tab Theree - stats -->
                            <div class="tab-pane" id="stats">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="stats-info">
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-xl-4">
                                        <!-- Attack -->
                                        <div class="panel-box">
                                            <div class="titles no-margin">
                                                <h4><i class="fa fa-calendar"></i>Goles</h4>
                                            </div>
                                            <ul class="list-panel">
                                                <li><p>Goles totales<span>{{ $player->goal[0]->cantidad }}</span></p></li>
                                                <li><p>Goles por partido <span>{{ $player->goal[0]->cantidad / $player->played }}</span></p></li>
                                                <li><p>Goles por torneo <span>{{ $player->goal[0]->cantidad / $player->team->tournament }}</span></p></li>
                                                <li><p>Goles por temporada <span>{{ $player->goal[0]->cantidad }}</span></p></li>
                                            </ul>
                                        </div>
                                        <!-- End Attack -->
                                    </div>

                                    <div class="col-lg-6 col-xl-4">
                                        <!-- Attack -->
                                        <div class="panel-box">
                                            <div class="titles no-margin">
                                                <h4><i class="fa fa-calendar"></i>Tarjetas</h4>
                                            </div>
                                            <ul class="list-panel">
                                                <li><p>Rojas <span>{{ $player->red[0]->cantidad }}</span></p></li>
                                                <li><p>Amarillas <span>{{ $player->yellow[0]->cantidad }}</span></p></li>
                                                <li><p>Verdes<span>{{ $player->green[0]->cantidad }}</span></p></li>
                                                <li><p>Fairplay <span>{{ $player->fairplay }}</span></p></li>
                                                
                                            </ul>
                                        </div>
                                        <!-- End Attack -->
                                    </div>

                                    <div class="col-lg-6 col-xl-4">
                                        <!-- Attack -->
                                        <div class="panel-box">
                                            <div class="titles no-margin">
                                                <h4><i class="fa fa-calendar"></i>Partidos</h4>
                                            </div>
                                            <ul class="list-panel">
                                                <li><p>Ganados <span>{{ $player->team->won }}</span></p></li>
                                                <li><p>Perdidos <span>{{ $player->team->lost }}</span></p></li>
                                                <li><p>Empatados <span>{{ $player->team->tied }}</span></p></li>
                                                <li><p>Porcentaje de victoria <span>{{ $player->team->won / $player->team->played->count() }}</span></p></li>
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
                </div>
            </div>
        </div>
        <!-- Single Team Tabs -->
    </section>

@endsection