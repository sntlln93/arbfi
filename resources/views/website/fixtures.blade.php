@extends('layouts.web_layout.front_design')

@section('content')
            <!-- Section Area - Content Central -->
            <section class="content-info">

                    <div class="container paddings-mini">
                        <div class="row">
    
                            <div class="col-lg-12">
                                <h3 class="clear-title">Partidos</h3>
                            </div>
    
                            <div class="col-lg-12">
                                <table class="table-striped table-responsive table-hover">
                                    <thead>
                                        <tr>
                                            <th>Local</th>
                                            <th class="text-center">VS</th>
                                            <th>Visitante</th>
                                            <th>Detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($fixtures as $match)
                                            @if(isset($match->local) AND isset($match->visiting))
                                                <tr>
                                                    <td>
                                                        <img src="{{asset('storage/'.$match->local_image)}}" alt="icon">
                                                        <strong>{{ $match->local }}</strong><br>
                                                        <small class="meta-text">{{ $match->category }}</small>
                                                    </td>
                                                    <td class="text-center">Vs</td>
                                                    <td>
                                                        <img src="{{asset('storage/'.$match->visiting_image)}}" alt="icon">
                                                        <strong>{{ $match->visiting }}</strong><br>
                                                        <small class="meta-text">{{ $match->category }}</small>
                                                    </td>
                                                    <td>
                                                        Fecha: {{ $match->date}}<br>
                                                        <small class="meta-text">Cancha: {{$match->location}}</small>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
    
                </section>
                <!-- End Section Area -  Content Central -->
    @endsection