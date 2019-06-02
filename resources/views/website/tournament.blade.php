@extends('layouts.web_layout.front_design')
@section('content')
<section class="content-info">
    <div class="portfolioFilter">
        <div class="container">
            <h5><i class="fa fa-filter" aria-hidden="true"></i>Filtrar:</h5>
            <a href="#" data-filter="*" class="current">Todos</a>
            @foreach($categories as $category)
                <a href="#" data-filter="{{'.'.$category->name}}">{{ $category->name }}</a>
            @endforeach
        </div>
    </div>
    
    <div class="container paddings-mini ">
        <div class="row portfolioContainer">
            <!-- category tables -->
           @foreach($categories as $category)
            <div class="col-lg-12 {{ $category->name }}">
                    <table class="table-striped table-responsive table-hover result-point">
                        <thead class="point-table-head">
                            <tr>
                                <th colspan="10" class="text-center">Categoría {{ $category->name }}</th>
                            </tr>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-left">Equipo</th>
                                <th class="text-center">PJ</th>
                                <th class="text-center">PG</th>
                                <th class="text-center">PE</th>
                                <th class="text-center">PP</th>
                                <th class="text-center">GF</th>
                                <th class="text-center">GC</th>
                                <th class="text-center">+/-</th>
                                <th class="text-center">PTS</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            <tr>
                                @php($n=0)
                                @foreach($scoreboard as $score)
                                    @if($category->id == $score->team->category_id)
                                        <tr>
                                            <td class="number">{{ $n+1 }}</td>
                                            <td class="text-left">
                                                <!--<img src="{{ $score->team->club->path_file }}" alt="{{ $score->team->club->name }}">-->
                                                <span>{{ $score->team->club->name }} ( CAT. {{ $score->team->category->name }})</span>
                                            </td>
                                            
                                            <td>{{ $score->wins + $score->ties + $score->losses }}</td>
                                            <td>{{ $score->wins }}</td>
                                            <td>{{ $score->ties }}</td>
                                            <td>{{ $score->losses }}</td>
                                            <td>{{ $score->goals_favor }}</td>
                                            <td>{{ $score->goals_against }}</td>
                                            <td>{{ $score->goals_favor - $score->goals_against }}</td>
                                            <td>{{ $score->points }}</td>
                                        </tr>
                                        @php($n++)
                                    @endif
                                @endforeach
                            </tr>
                        </tbody>
                    </table>

            </div>
           @endforeach

        </div>
    </div>
   
</section>
@endsection