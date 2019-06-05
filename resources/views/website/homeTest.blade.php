@extends('layouts.web_layout.front_design')
@section('content')
<!-- Section Area - Content Central -->
<section class="content-info">
        <div class="portfolioFilter">
                <div class="container">
                    <h5><i class="fa fa-filter" aria-hidden="true"></i>Filtrar:</h5>
                    <a onclick="myFunction(e)" href="#" data-filter=".general" class="current">Copa Challenger</a>
                    @foreach($categories as $category)
                        <a id="filter" onclick="myFunction(e)" href="#" data-filter="{{'.'.$category->name}}">Categoría {{ $category->name }}</a>
                    @endforeach
                </div>
            </div>
    <!-- Dark Home -->
    <div class="dark-home paddings-50-50">
        <div class="container">
            <div id="general" class="row portfolioContainer">
                <!-- General table -->
                <div class="col-lg-4 general">
                    <div class="club-ranking">
                        <h5><a>Tabla de Posiciones</a></h5>
                        <div class="info-ranking">
                            <ul>
                                @php( $position = 1 )
                                @foreach($scores as $scoreboard)
                                    <li>
                                        <span class="position">
                                            {{ $position }}
                                        </span>
                                        <a>
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

                <!-- next-matches -->
                <div class="col-lg-4 general">
                    <div class="recent-results">
                        <h5><a>Próximos partidos</a></h5>
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
                                                <a href="{{ url('/web/teams/'.$recent->local->id ) }}">
                                                    <img src="{{ asset($recent->local->club->path_file) }}" alt="">
                                                    {{ $recent->local->club->name }}
                                                </a>

                                                <span class="goals">
                                                    <b style="color:red">0</b> - <b style="color:red">0</b>
                                                </span>

                                                <a href="{{ url('/web/teams/'.$recent->visiting->id ) }}">
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
                <!-- end next-matches -->

                <!-- recent-results -->
                <div class="col-lg-4 general">
                    <div class="recent-results">
                        <h5><a>Partidos recientes</a></h5>
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
                                                <a>
                                                    <img src="{{ asset($tocome->local->club->path_file) }}" alt="">
                                                    {{ $tocome->local->club->name }}
                                                </a>

                                                <span class="goals">
                                                    <b style="color:green">{{ $tocome->local_score}}</b> - <b style="color:green">{{ $tocome->visiting_score }}</b>
                                                </span>

                                                <a>
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
                <!-- end-recent-results -->
                <!-- categories table -->
                @foreach($categories as $category)
                    <div class="col-lg-4 {{ $category->name }}" style="display:none">
                        <div class="club-ranking">
                            <h5><a>Categoría {{ $category->name }}</a></h5>
                            <div class="info-ranking">
                                <ul>
                                    @php( $position = 1 )
                                    @foreach($scoreboards as $row)
                                        @if($category->id == $row->team->category_id)
                                            <li>
                                                <span class="position">
                                                    {{ $position }}
                                                </span>
                                                <a>
                                                    <img src="{{--logo --}}" alt="">
                                                    {{ $row->team->club->name }}
                                                </a>
                                                <span class="points">
                                                    {{ $row->points }}
                                                </span>
                                            </li>
                                            @php( $position++ )
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Club Ranking -->
    
                    <!-- recent-results -->
                    <div class="col-lg-4 {{ $category->name }}" style="display:none">
                        <div class="recent-results">
                            <h5><a>Próximos partidos</a></h5>
                            <div class="info-results">
                                <ul>
                                    @if(count($recents))
                                        @php($i=0)
                                        @foreach($recents as $recent)
                                            @if($recent->local->category_id == $category->id)
                                                <li>
                                                    <span class="head">
                                                        {{ $recent->tournament->name}} (CAT. {{ $recent->local->category->name }}) <span class="date">{{ $recent->date }}</span>
                                                    </span>
        
                                                    <div class="goals-result">
                                                        <a href="{{ url('/web/teams/'.$recent->local->id ) }}">
                                                            <img src="{{ asset($recent->local->club->path_file) }}" alt="">
                                                            {{ $recent->local->club->name }}
                                                        </a>
        
                                                        <span class="goals">
                                                            <b style="color:red">0</b> - <b style="color:red">0</b>
                                                        </span>
        
                                                        <a href="{{ url('/web/teams/'.$recent->visiting->id ) }}">
                                                            <img src="{{ asset($recent->visiting->club->path_file) }}" alt="">
                                                            {{ $recent->visiting->club->name }}
                                                        </a>
                                                    </div>
                                                </li>
                                                @php($i++)
                                            @endif
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
                    <div class="col-lg-4 {{ $category->name }}" style="display:none">
                        <div class="recent-results">
                            <h5><a>Partidos recientes</a></h5>
                            <div class="info-results">
                                <ul>
                                    @if(count($next))
                                        @php($i=0)
                                        @foreach($next as $tocome)
                                            @if($tocome->local->category_id == $category->id)
                                                <li>
                                                    <span class="head">
                                                        {{ $tocome->tournament->name }} (CAT. {{ $tocome->local->category->name }}) <span class="date">{{ $tocome->date }}</span>
                                                    </span>
        
                                                    <div class="goals-result">
                                                        <a href="{{ url('/teams/'.$tocome->local->id) }}">
                                                            <img src="{{ asset($tocome->local->club->path_file) }}" alt="">
                                                            {{ $tocome->local->club->name }}
                                                        </a>
        
                                                        <span class="goals">
                                                            <b style="color:green">{{ $tocome->local_score}}</b> - <b style="color:green">{{ $tocome->visiting_score }}</b>
                                                        </span>
        
                                                        <a href="{{ url('/teams/'.$tocome->visiting->id) }}">
                                                            <img src="{{ asset($tocome->visiting->club->path_file) }}" alt="">
                                                            {{ $tocome->visiting->club->name }}
                                                        </a>
                                                    </div>
                                                </li>
                                                @php($i++)
                                            @endif
                                        @if($i == 3) @break;
                                        @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Top player -->
                @endforeach
            </div>
        </div>
    </div>

    
    <!-- Content Central -->
    <div class="container padding-top">
        <div class="row">
                <div class="col-lg-6 col-xl-12" style="padding-bottom: 2%">
                        <div class="adds">
                            <a href="http://www.andinalr.com.ar/" target="_blank">
                                <img src="{{ asset('img/frontend_img/adds/banner.jpg') }}" alt="" class="img-responsive">
                            </a>
                        </div>
                </div>
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
                                    <p>{{ Str_limit($post->body, 350) }}<a href="{{ url('/posts/'.$post->id) }}">Leer más [+]</a></p>
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

<script>
    function myFunction(e){
        var div, i;
        /*for(i = 0; i < $categories.length(); i++){
            div = document.getElementById("table_"+$category[i].name);
            div.style.display = "";
        }*/

        e.target.style.display = "";
    }
</script>
@endsection