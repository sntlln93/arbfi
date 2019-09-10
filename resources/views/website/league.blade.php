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
                                        <!--<img src="" alt="{{ $row['name'] }}">-->
                                        <span>{{ $row['name'] }}</span>
                                    </td>
                                    
                                    <td>{{ $row['wins'] + $row['ties'] + $row['losses'] }}</td>
                                    <td>{{ $row['wins'] }}</td>
                                    <td>{{ $row['ties'] }}</td>
                                    <td>{{ $row['losses'] }}</td>
                                    <td>{{ $row['goals_favor'] }}</td>
                                    <td>{{ $row['goals_against'] }}</td>
                                    <td>{{ $row['goals_favor'] - $row['goals_against'] }}</td>
                                    <td><b>{{ $row['points'] }}<b></td>
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
                                @foreach($tables as $key=>$categories)
                                    @foreach($categories as $subkey=>$row)
                                        @if($category->id == $key)
                                            <tr>
                                                <td class="number">{{ $n+1 }}</td>
                                                <td class="text-left">
                                                    <span>{{ $row['name'] }}</span>
                                                </td>
                                                <td>{{ $row['wins'] + $row['ties'] + $row['losses'] }}</td>
                                                <td>{{ $row['wins'] }}</td>
                                                <td>{{ $row['ties'] }}</td>
                                                <td>{{ $row['losses'] }}</td>
                                                <td>{{ $row['goals_favor'] }}</td>
                                                <td>{{ $row['goals_against'] }}</td>
                                                <td>{{ $row['goals_favor'] - $row['goals_against'] }}</td>
                                                <td><b>{{ $row['points'] }}<b></td>
                                            </tr>
                                            @php($n++)
                                        @endif
                                    @endforeach
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