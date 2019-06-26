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
                            <!-- Tab One - squad -->
                            <div class="tab-pane active" id="squad">
                                <div class="row">
                                    <table class="table-striped table-responsive table-hover" style="margin-bottom:35px">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Apellido y nombre</th>
                                                <th class="text-center">Categoría</th>
                                                <th class="text-center">Goles</th>
                                                <th class="text-center">Tarjetas verdes</th>
                                                <th class="text-center">Tarjetas amarillas</th>
                                                <th class="text-center">Tarjetas rojas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($team->players as $player)
                                                <tr>
                                                    <td class="text-center">{{ $player->last_name }} {{ $player->first_name }}</td>
                                                    <td class="text-center">{{ $player->team->category->name }}</td>
                                                    <td class="text-center">{{ $player->goal[0]->cantidad }}</td>
                                                    <td class="text-center">{{ $player->green[0]->cantidad }}</td>
                                                    <td class="text-center">{{ $player->yellow[0]->cantidad }}</td>
                                                    <td class="text-center">{{ $player->red[0]->cantidad }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr>                                    
                                    <hr>
                                </div>
                            </div>
                            <!-- End Tab Two - Fixture -->
                            <div class="tab-pane" id="fixtures">
                                <table class="table-striped table-responsive table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Local</th>
                                            <th class="text-center">VS</th>
                                            <th class="text-center">Visitante</th>
                                            <th class="text-center">Detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($fixtures as $match)
                                                @if($match->state = "no jugado")
                                                    <tr>
                                                        <td>
                                                            <img src="{{ asset($match->local->club->path_file) }}" alt="icon">
                                                            <strong>{{ $match->local->club->name }}</strong><br>
                                                        </td>
                                                        <td class="text-center">Vs</td>
                                                        <td>
                                                            <img src="{{ asset($match->visiting->club->path_file) }}" alt="icon">
                                                            <strong>{{ $match->visiting->club->name }}</strong><br>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $match->date }}<br>
                                                            <small class="meta-text">Ubicación: {{ $match->location }}</small>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                    </tbody>
                                </table>
                                <hr>
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
                                                                    <img src="{{ $match->local->club->path_file }}" alt="">
                                                                    {{ $match->local->club->name }}
                                                                </a>
            
                                                                <span class="goals">
                                                                    <b>{{ $match->local_score }}</b> - <b>{{ $match->visiting_score }}</b>
                                                                </span>
            
                                                                <a href="{{ url('/web/teams/'.$match->visiting_team_id) }}">
                                                                    <img src="{{ $match->local->club->path_file }}" alt="">
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