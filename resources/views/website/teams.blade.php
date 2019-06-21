@extends('layouts.web_layout.front_design')
@section('content')
<section class="content-info">

    <!-- Nav Filters -->
    <div class="portfolioFilter">
        <div class="container">
            <h5><i class="fa fa-filter" aria-hidden="true"></i>Filtrar:</h5>
            <a href="#" data-filter="*" class="current">Mostrar todos</a>
            @foreach($categories as $category)
                <a href="#" data-filter="{{'.'.$category->name}}">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
    <!-- End Nav Filters -->

    <div class="container padding-top">
        <div class="row portfolioContainer">

            @foreach($categories as $category)
                @foreach($category->teams as $team)
                    <div class="col-md-6 col-lg-4 col-xl-3 {{ $category->name }}">
                        <div class="item-team">
                            <div class="head-team">
                                <img src="{{ $team->club->path_file }}" alt="location-team">
                                <div class="overlay"><a href="{{ url('/web/teams/'.$team->id ) }}">+</a></div>
                            </div>
                            <div class="info-team">
                                <span class="logo-team">
                                    <img src="{{ $team->club->path_file }}" alt="logo-team">
                                </span>
                                <h5>{{ $team->club->name }}</h5>
                                <span class="location-team">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    {{ Str::limit($team->club->stadium, 16) }}
                                </span>
                                <span class="group-team">
                                    <i class="fa fa-trophy" aria-hidden="true"></i>
                                    {{ '"'.$team->category->name }}
                                </span>
                            </div>
                            <a href="{{ url('/web/teams/'.$team->id ) }}" class="btn">Ver equipo <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>
@endsection