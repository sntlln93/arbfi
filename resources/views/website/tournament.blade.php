@extends('layouts.web_layout.front_design')
@section('content')
<section class="content-info">
    
    @foreach($categories as $category)<div class="container paddings-mini">
        <div class="row">                
            <div class="col-lg-12">
                <table class="table-striped table-responsive table-hover result-point">
                    <thead class="point-table-head">
                        <tr><th class="text-center" colspan="8">Categoría {{ $category->name }}</th></tr>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-left">Equipo</th>
                            <th class="text-center">PG</th>
                            <th class="text-center">PE</th>
                            <th class="text-center">PP</th>
                            <th class="text-center">GF</th>
                            <th class="text-center">GC</th>
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
                                            <td>{{ $score->wins }}</td>
                                            <td>{{ $score->ties }}</td>
                                            <td>{{ $score->losses }}</td>
                                            <td>{{ $score->goals_favor }}</td>
                                            <td>{{ $score->goals_against }}</td>
                                            <td>{{ $score->points }}</td>
                                        </tr>
                                        @php($n++)
                                    @endif
                                @endforeach
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
</section>
@endsection