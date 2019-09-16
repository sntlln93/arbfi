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
                                @foreach($challenger as $club=>$team)
                                    @if(! ($team->name == 'FERROCARRIL OESTE' OR $team->name == 'GAUCHITOS DE BOEDO') )
                                        <li>
                                            <span class="position">
                                                {{ $position }}
                                            </span>
                                            <a>
                                                
                                                {{ $team->name }}
                                            </a>
                                            <span class="points">
                                                {{ $team->points }}
                                            </span>
                                        </li>
                                        @php( $position++ )
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                 <!-- End general table -->
                <!-- Top player -->
                <div class="col-lg-4 general">
                    <div class="player-ranking">
                         <h5><a href="group-list.html">Goleadores</a></h5>
                         <div class="info-player">
                             <ul>
                                @php($n = 0)
                                @foreach($goal_makers as $goal_maker)
                                    @if( $n < 6)
                                        <li>
                                            <span class="position">
                                                {{ $n+1 }}
                                            </span>
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

                <!-- Fair Play  -->
                <div class="col-lg-4 general">
                    <div class="player-ranking">
                         <h5><a href="group-list.html">Tabla de Fair Play</a></h5>
                         <div class="info-player">
                             <ul>
                                 <li>
                                   <span class="position">
                                       1
                                   </span>
                                    <a href="single-team.html">
                                         <img src="{{ asset('/') }}" alt="">
                                         Cristiano R.
                                     </a>
                                     <span class="points">
                                         90
                                     </span>
                                 </li>
                             </ul>
                         </div>
                    </div>
                 </div>
                 <!-- end-fair play-->
                @foreach($categories as $category)
                    <!-- Club Ranking -->
                    <div class="col-lg-4 {{ $category->name }}" style="display:none">
                        <div class="club-ranking">
                            <h5><a>Categoría {{ $category->name }}</a></h5>
                            <div class="info-ranking">
                                <ul>
                                    @php( $position = 1 )
                                    @foreach($scoreboards[$category->id] as $team)
                                        @if(! ($team->name == 'FERROCARRIL OESTE' OR $team->name == 'GAUCHITOS DE BOEDO') )
                                                <li>
                                                    <span class="position">
                                                        {{ $position }}
                                                    </span>
                                                    <a>
                                                        <img src="" alt="">
                                                        {{ $team->name }}
                                                    </a>
                                                    <span class="points">
                                                        {{ $team->points }}
                                                    </span>
                                                </li>
                                                @php( $position++)
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Club Ranking -->
    
                    <!-- Top player -->
                    <div class="col-lg-4 {{ $category->name }}" style="display:none">
                        <div class="player-ranking">
                            <h5><a href="group-list.html">Goleadores</a></h5>
                            <div class="info-player">
                                <ul>
                                    @php($n = 0)
                                    @foreach($goal_makers as $goal_maker)
                                        @if($category->name == $goal_maker->name)
                                            @if($n < 6)
                                                <li>
                                                    <span class="position">
                                                        {{ $n+1 }}
                                                    </span>
                                                    <a href="$">
                                                        <img style="width:20px;height:20px;" src="{{ asset('storage/'.$goal_maker->image_id) }}" alt="">
                                                        {{ $goal_maker->first_name.' '.$goal_maker->last_name }}
                                                    </a>
                                                    <span class="points">
                                                        {{ $goal_maker->goals}}
                                                    </span>
                                                </li>
                                            @endif
                                            @php($n++)
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Top player -->
    
                    <!-- Fair Play -->
                    <div class="col-lg-4 {{ $category->name }}" style="display:none">
                        <div class="player-ranking">
                            <h5><a href="group-list.html">Tabla de Fair Play</a></h5>
                            <div class="info-player">
                                <ul>
                                    @php( $n = 0 )
                                    @for($i = 0; $i < sizeof($fair_play); $i++)
                                        @if($fair_play[$i][0]['Categoria'] == $category->name)
                                            @foreach(array_reverse($fair_play[$i]) as $row)
                                                @if($n < 6)
                                                    <li>
                                                        <span class="position">
                                                            {{ $n+1 }}
                                                        </span>
                                                        <a href="$">
                                                            {{ $row['Equipo'].' (R:'.$row['Roja'].'/A:'.$row['Amarilla'].'/V:'.$row['Verde'].')' }}
                                                        </a>
                                                        <span class="points">
                                                            {{ $row['Puntos']}}
                                                    </li>
                                                @endif
                                                @php($n++)
                                            @endforeach
                                        @endif
                                    @endfor
                                </ul>
                            </div>
                        </div>
                    </div>
                   <!-- end-fair play-->
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
                                        <img src="{{ App\Image::find($post->image_id)->path }}" alt="" class="img-responsive">
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

<script>
    function myFunction(e){
        var div, i;
        e.target.style.display = "";
    }
</script>
@endsection