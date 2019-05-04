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
                        <h5><a href="group-list.html">Próximos partidos</a></h5>
                        <div class="info-results">
                            <ul>
                                @if(count($recents))
                                    @php($i=0)
                                    @foreach($recents as $recent)
                                    
                                        <li>
                                            <span class="head">
                                                {{ $recent->tournament->name}} (CAT. {{ $recent->local->category->name }}) <span class="date">{{ $recent->date }}</span>
                                            </span>

                                            <div class="goals-result">
                                                <a href="single-team.html">
                                                    <img src="{{ asset($recent->local->club->path_file) }}" alt="">
                                                    {{ $recent->local->club->name }}
                                                </a>

                                                <span class="goals">
                                                    <b style="color:red">0</b> - <b style="color:red">0</b>
                                                </span>

                                                <a href="single-team.html">
                                                    <img src="{{ asset($recent->visiting->club->path_file) }}" alt="">
                                                    {{ $recent->visiting->club->name }}
                                                </a>
                                            </div>
                                        </li>
                                        @php($i++)
                                        @if($i == 3) @break;
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end recent-results -->

                <!-- Próximos partidos -->
                <div class="col-lg-4">
                    <div class="recent-results">
                        <h5><a href="group-list.html">Partidos recientes</a></h5>
                        <div class="info-results">
                            <ul>
                                @if(count($next))
                                    @php($i=0)
                                    @foreach($next as $tocome)
                                        <li>
                                            <span class="head">
                                                {{ $tocome->tournament->name }} (CAT. {{ $tocome->local->category->name }}) <span class="date">{{ $tocome->date }}</span>
                                            </span>

                                            <div class="goals-result">
                                                <a href="single-team.html">
                                                    <img src="{{ asset($tocome->local->club->path_file) }}" alt="">
                                                    {{ $tocome->local->club->name }}
                                                </a>

                                                <span class="goals">
                                                    <b style="color:green">{{ $tocome->local_score}}</b> - <b style="color:green">{{ $tocome->visiting_score }}</b>
                                                </span>

                                                <a href="single-team.html">
                                                    <img src="{{ asset($tocome->visiting->club->path_file) }}" alt="">
                                                    {{ $tocome->visiting->club->name }}
                                                </a>
                                            </div>
                                        </li>
                                    @php($i++)
                                    @if($i == 3) @break;
                                    @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Top player -->
            </div>
        </div>
    </div>

    
    <!-- Content Central -->
    <div class="container padding-top">
        <div class="row">

            <!-- content Column Left -->
            <div class="col-lg-6 col-xl-8">
                <!-- Recent Post -->
                
                <div class="panel-box">
                    <div class="titles">
                        <h4>Noticias recientes</h4>
                    </div>
                    <!-- Post Item -->
                    @foreach($posts as $post)
                        <div class="post-item">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="img-hover">
                                        <img src="{{ $post->path_file }}" alt="" class="img-responsive">
                                        <div class="overlay"><a href="{{ url('/posts/'.$post->id) }}">+</a></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5><a href="{{ url('/posts/'.$post->id) }}">{{ $post->title }}</a></h5>
                                    <span class="data-info">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }} </span>
                                    <p>{{ str_limit($post->body, 350) }}<a href="{{ url('/posts/'.$post->id) }}">Leer más [+]</a></p>
                                </div>
                            </div>
                        </div>
                        <hr/>
                    @endforeach
                        <!-- End Post Item -->
                </div>
                <!-- End Recent Post -->
            </div>
             <!-- End content Left -->

            <!-- content Sidebar Center -->
            <aside class="col-sm-5 col-lg-5 col-xl-4">

                <!-- Widget img-->
                <div class="panel-box">
                    <div class="titles no-margin">
                        <h4>Auspiciante</h4>
                    </div>
                    <a href="http://www.transportechilecito.com.ar" target="_blank">
                    <img src="{{ asset('img/frontend_img/adds/chilecito_v.png') }}" alt="">
                </div>
                <!-- End Widget img-->
            </aside>
            <!-- End content Sidebar Center -->

        </div>
    </div>
    <!-- End Content Central -->
    
</section>
<!-- End Section Area -  Content Central -->
@endsection