@extends('layouts.front_layout.front_design')

@section('content')
    <section class="content-info">
        <!-- Nav Filters -->
        <div class="portfolioFilter">
            <div class="container">
                <h5><i class="fa fa-filter" aria-hidden="true"></i>Mostrar:</h5>
                {{--@foreach ($categories as $category)
                    <a href="#" data-filter="{{'.'.$category->name}}">{{ 'Categoría '.$category->name }}</a>    
                @endforeach--}}
            </div>
        </div>
        <!-- End Nav Filters -->
        
        <div class="container paddings-mini">
            <div class="row portfolioContainer">
                <div class="col-lg-12 group-a">
                    <table class="table-striped table-responsive table-hover result-point">
                        <thead class="point-table-head">
                            <tr>
                                <th class="text-left">No</th>
                                <th class="text-left">Equipo</th>
                                <th class="text-center">PJ</th>
                                <th class="text-center">PG</th>
                                <th class="text-center">PE</th>
                                <th class="text-center">PP</th>
                                <th class="text-center">GF</th>
                                <th class="text-center">GC</th>
                                <th class="text-center">+/-</th>
                                <th class="text-center">Pts</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                            <tr>
                                <td class="text-left number">1 <i class="fa fa-caret-up" aria-hidden="true"></i></td>
                                <td class="text-left">
                                    <img src="{{ asset('img/frontend_img/clubs-logos/colombia.png')}}" alt="Colombia"><span>Colombia</span>
                                </td>
                                <td>38</td>
                                <td>26</td>
                                <td>9</td>
                                <td>3</td>
                                <td>73</td>
                                <td>32</td>
                                <td>+41</td>
                                <td>87</td>
                            </tr>
                            {{--@foreach($scoreboards as $team)
                                @php($pj = $team->wins+$teams->ties+$teams->losses)
                                @php($diff = $team->goals_favor-$team->goals_against)
                                <tr>
                                    <td class="text-left number">1 <i class="fa fa-caret-up" aria-hidden="true"></i></td>
                                    <td class="text-left">
                                        <img src="{{ $team->team->institution->logo }}" alt="{{ $team->team->name }}">
                                        <span>{{ $team->team->name }}</span>
                                    </td>
                                    <td>{{ $pj }}</td>
                                    <td>{{ $team->wins }}</td>
                                    <td>{{ $team->ties }}</td>
                                    <td>{{ $team->losses }}</td>
                                    <td>{{ $team->goals_favor }}</td>
                                    <td>{{ $team->goals_against }}</td>
                                    <td>{{ $diff }}</td>
                                    <td>{{ $team->points }}</td> 
                                </tr>
                            @endforeach--}} 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection