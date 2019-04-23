@extends('layouts.web_layout.front_design')

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
                                                <img src="{{ asset( $player->path_file) }}" alt="location-team">
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
                                                        <strong>CATEGORIA</strong> <span><img src="{{ asset($team->club->path_file) }}" alt=""> {{ $player->team->category->name}} </span>
                                                    </li>
                                                    <li><strong>PARTIDOS:</strong> <span>0 <!--{-- $player->team->fixture->count() --}}--></span></li>
                                                    <li><strong>EDAD:</strong> <span> {{ $player->birth_date->diffInYears() }}</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            <!-- End Tab Two - squad -->
                            <div class="tab-pane" id="fixtures">

                                    <table class="table-striped table-responsive table-hover">
                                        <thead>
                                            <tr>
                                                <th>Local</th>
                                                <th class="text-center">VS</th>
                                                <th>Visitante</th>
                                                <th>Detalles</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($fixtures as $match)
                                                    @if($match->state = "no jugado")
                                                        <tr>
                                                            <td>
                                                                <img src="{{ asset($match->local->club->path_file) }}" alt="icon">
                                                                <strong>{{ $match->local->club->name}}</strong><br>
                                                            </td>
                                                            <td class="text-center">Vs</td>
                                                            <td>
                                                                <img src="{{ asset($match->visiting->club->path_file) }}" alt="icon">
                                                                <strong>{{ $match->visiting->club->name}}</strong><br>
                                                            </td>
                                                            <td>
                                                                {{ $match->date }}<br>
                                                                <small class="meta-text">Cancha: {{ $match->location }}</small>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                        </tbody>
                                    </table>
                            </div>
                            
    
                            <!-- Tab Theree - results -->
                            
                                <div class="tab-pane" id="results">
                                    <div class="recent-results results-page">
                                        <div class="info-results">
                                            <ul>
                                                @foreach($fixtures as $match)
                                                    @if($match->state == "JUGADO")
                                                        <li>
                                                            <span class="head">
                                                                {{ $match->local->club->name }} Vs {{ $match->visiting->club->name }} <span class="date">{{ $match->date }}</span>
                                                            </span>
            
                                                            <div class="goals-result">
                                                                <a href="{{ url('/web/teams/'.$match->local_team_id) }}">
                                                                    <img src="{{ asset($match->local->club->path_file) }}" alt="">
                                                                    {{ $match->local->club->name }}
                                                                </a>
            
                                                                <span class="goals">
                                                                    <b>{{ $match->local_score }}</b> - <b>{{ $match->visiting_score }}</b>
                                                                </span>
            
                                                                <a href="{{ url('/web/teams/'.$match->visiting_team_id) }}">
                                                                    <img src="{{ asset($match->visiting->club->path_file) }}" alt="">
                                                                    {{ $match->visiting->club->name }}
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
                           
                        </div>
                        <!-- Content Tabs -->
                        
                       
                    </div>


                </div>
            </div>
        </div>
        <!-- Single Team Tabs -->
    </section>
@endsection