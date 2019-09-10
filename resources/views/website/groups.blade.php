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
    

    <div class="container padding-top">
            <div class="groups-list page-group">
                <div class="row portfolioContainer">
                    @foreach($tournament->groups as $group)
                        <div class="col-lg-6 col-md-6 col-sm-12 {{ $group->fixture->first()->local->category->name }}">
                            <h5><a href="groups.html">GRUPO {{ $group->name }}</a></h5>
                            <div class="item-group">
                                <table class="table-striped table-responsive table-hover result-point">
                                    <thead class="point-table-head">
                                        <tr>
                                            <th class="text-left">Equipo</th>
                                            <th class="text-center"><b>PTS</b></th>
                                            <th class="text-center">PG</th>
                                            <th class="text-center">PE</th>
                                            <th class="text-center">PP</th>
                                            <th class="text-center">GF</th>
                                            <th class="text-center">GC</th>
                                        </tr>
                                    </thead>
                
                                    <tbody class="text-center">
                                        @foreach($group->scoreboard as $category)
                                            @foreach($category as $team)
                                                <tr>
                                                    <td class="text-left">
                                                        <span>{{ $team['name'] }}</span>
                                                    </td>
                                                    <td><b>{{ $team['points'] }}<b></td>
                                                    <td>{{ $team['wins'] }}</td>
                                                    <td>{{ $team['ties'] }}</td>
                                                    <td>{{ $team['losses'] }}</td>
                                                    <td>{{ $team['goals_favor'] }}</td>
                                                    <td>{{ $team['goals_against'] }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>      
                    @endforeach
                </div>
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