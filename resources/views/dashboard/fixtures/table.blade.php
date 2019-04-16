@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id='content'>
	<div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/inicio') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Partidos</i></a></div>
    </div>
    
    <div class="container-fluid">
      <div class="pull-right">
        <div class="controls">
          <br>
          <div class="input-append">
              <input id="filtrar" name="search" value="" type="text" placeholder="Buscar" class="span3">
              <span class="add-on"><i class="icon-search"></i></span>
          </div>
          <div class="input-append">
              
          </div>
          
        </div>
      </div>

      <div class="widget-box">
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table table-responsive-lg">
              <thead>
                <tr>
                    <th>ID</th>
                    <th>Torneo (Categoría)</th>
                    <th>Local</th>
                    <th>Visitante</th>
                    <th>Fecha</th>
                    <th>Jornada</th>
                    <th>Cancha</th>
                    <th>Estado</th>
                    
                    <th><i class="icon-pencil"></i></th>
                    
                </tr>
              </thead>
              <tbody>
                @foreach($fixtures as $match)
                  <tr>
                    <th> {{ $match->id }} </th>
                    <th> {{ $match->tournament->name }} ({{ $match->local->category->name }})</th>
                    <th> {{ $match->local->club->name }} @if($match->state == 'JUGADO')({{ $match->local_score }})@endif </th>
                    <th> {{ $match->visiting->club->name }} @if($match->state == 'JUGADO')({{ $match->visiting_score }})@endif </th>
                    <th> {{ $match->date }} </th>
                    <th> {{ $match->fixture_day }} </th>
                    <th> {{ $match->location }} </th>
                    <th> {{ mb_strToUpper($match->state) }} </th>

                    
                    <th>
                      <a class="btn btn-mini btn-warning {{ $match->state == 'JUGADO' ? 'disabled' : '' }}" href="{{ url('/fixtures/'.$match->id.'/edit') }}"><i class="icon-pencil"></i></a>
                      
                    </th>
                    
                  
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </div>
    </div>
</div>

<script>
    $(function () {
    $('input#filtrar').quicksearch('table tbody tr');               
    });
</script>

@endsection