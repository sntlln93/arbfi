@extends('layouts.web_layout.front_design')
@section('content')

<section class="content-info">
    <div class="portfolioFilter">
        <div class="container">
            <h5><i class="fa fa-filter" aria-hidden="true"></i>Filtrar:</h5>
            <a href="#" data-filter=".general" class="current">Tabla General</a>
            @foreach($categories as $category)
                <a id="filter" onclick="myFunction()" href="#" data-filter="{{'.'.$category->name}}">Categoría {{ $category->name }}</a>
            @endforeach
        </div>
    </div>
    
    <div class="container paddings-mini ">
        <div class="row portfolioContainer">
            <!-- general table -->
            <div class="col-lg-12 general">
                <table class="table-striped table-responsive table-hover result-point">
                    <thead class="point-table-head">
                        <tr>
                            <th colspan="10" class="text-center">Tabla General</th>
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
                            <th class="text-center"><b>PTS</b></th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        <tr>
                            @php($n=0)
                            @foreach($general as $row)
                                <tr>
                                    <td class="number">{{ $n+1 }}</td>
                                    <td class="text-left">
                                        <!--<img src="" alt="{{ $row[0] }}">-->
                                        <span>{{ $row[0] }}</span>
                                    </td>
                                    
                                    <td>{{ $row[2] + $row[3] + $row[4] }}</td>
                                    <td>{{ $row[2] }}</td>
                                    <td>{{ $row[3] }}</td>
                                    <td>{{ $row[4] }}</td>
                                    <td>{{ $row[5] }}</td>
                                    <td>{{ $row[6] }}</td>
                                    <td>{{ $row[5] - $row[6] }}</td>
                                    <td><b>{{ $row[1] }}<b></td>
                                </tr>
                                @php($n++)
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>


            <!-- category tables -->
           @foreach($categories as $category)
                <div id="{{ 'table_'.$category->name}}" class="col-lg-12 {{ $category->name }}" style="display:none">
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
                                <th class="text-center"><b>PTS</b></th>
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
                                            <td><b>{{ $score->points }}<b></td>
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

<script>
    function myFunction(){
        var div, i;
        for(i = 0; i < $categories.length(); i++){
            div = document.getElementById("table_"+$category[i].name);
            div.style.display = "";
        } 
    }
 </script>
 
@endsection