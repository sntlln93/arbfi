@extends('layouts.web_layout.front_design')
@section('content')
<!-- Section Area - Content Central -->
<section class="content-info">
         <div class="portfolioFilter">
                <div class="container">
                    <h5><i class="fa fa-filter" aria-hidden="true"></i>Filtrar:</h5>
                    <a id="filter" onclick="myFunction(e)" href="#" data-filter=".GF" class="">Fase de Grupos</a>
                    <a id="filter" onclick="myFunction(e)" href="#" data-filter=".PVP" class="current">Eliminatoria</a>
                    <a id="filter" onclick="myFunction(e)" href="#" data-filter=".ST" class="">Estadísticas</a>
                </div>
            </div>
    <!-- Dark Home -->
    <div class="dark-home paddings-50-50">
        <div class="container">
            <div id="general" class="row portfolioContainer">
                    
                @foreach($tournament->groups as $group)
                    <!-- Club Ranking -->
                    <div class="col-lg-4 GF" style="display: none">
                        <div class="club-ranking">
                            <h5><a>Grupo {{ $group->name }}</a></h5>
                            <div class="info-ranking">
                                <ul>
                                    @foreach($group->scoreboard as $category)
                                        @foreach($category as $group)
                                            @foreach($group as $team)
                                                <li>
                                                    <a>
                                                        <img style="width:20px;height:20px;" src="{{ asset('storage/'.App\Institution::where('name', $team->name)->get()[0]->image->path) }}" alt="">
                                                        {{ $team->name }}
                                                    </a>
                                                    <span class="points">
                                                        {{ $team->points }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Club Ranking -->
                @endforeach
                    <!-- Top player -->
                    <div class="col-lg-6 ST" style="display:none;">
                        <div class="player-ranking">
                            <h5><a href="group-list.html">Goleadores</a></h5>
                            <div class="info-player">
                                <ul>
                                    @php($n = 0)
                                    @foreach($goal_makers as $goal_maker)
                                            @if($n < 10)
                                                <li>
                                                    <a href="$">
                                                        <img style="width:20px;height:20px;" src="{{ asset('storage/'.App\Image::find($goal_maker->image_id)->path) }}" alt="">
                                                        {{ $goal_maker->first_name.' '.$goal_maker->last_name }}
                                                    </a>
                                                    <span class="points">
                                                        {{ $goal_maker->goals}}
                                                    </span>
                                                </li>
                                            @endif
                                            @php($n++)
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Top player -->
    
                    <div class="PVP" style="text-align: center !important; padding-top:-10%">
                        <div class="tournament" style="margin: auto !important; "></div>
                    </div>
                
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
                                        @if($post->image_id)
                                        <img src="{{ asset('storage/'.App\Image::find($post->image_id)->path) }}" alt="" class="img-responsive">
                                        @endif
                                        <div class="overlay"><a href="{{ url('/posts/'.$post->id) }}">+</a></div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h5><a href="{{ url('/posts/'.$post->id) }}">{{ $post->title }}</a></h5>
                                    <span class="data-info">{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }} </span>
                                    <p>{{ Str::limit($post->body, 350) }}<a href="{{ url('/posts/'.$post->id) }}">Leer más [+]</a></p>
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

@section('scripts')

<script>
    function myFunction(e){
        var div, i;
        e.target.style.display = "";
    }
</script>   

<script>
        var minData = {
            teams: {!! json_encode($teams) !!},
            results: {!! json_encode($results) !!},
        }
    
        $('.tournament').bracket({
            teamWidth:150,
            init: minData
        });
    
    </script>

@endsection
