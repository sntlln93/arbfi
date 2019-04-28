@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id='content'>
	<div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/inicio') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Jugadores</i></a></div>
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
          <div class="input-append">
              <span><a class="btn btn-success" href="{{ '/players/create' }}"><i class="icon-plus"></i></a></span>
          </div>
        </div>
      </div>

      <div class="widget-box">
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table"><!--table-responsive-lg-->
              <thead>
                <tr>
                    <th>ID</th>
                    <th>Apellido y Nombre</th>
                    <th>DNI</th>
                    <th>Club</th>
                    <th>Categoría</th>
                    <th>Posición</th>
                    <th>Escuela</th>
                    <th>Obra Social</th>
                    <th><i class="icon-pencil"></i></th>
                    <th><i class="icon-trash"></i></th>
                </tr>
              </thead>
              <tbody>
                @foreach($players as $player)
                  <tr>
                    <th> {{ $player->id }} </th>
                    <th> {{ $player->last_name }} {{$player->first_name }} </th>
                    <th> {{ $player->dni }} </th>
                    <th> {{ $player->team->club->name }} </th>
                    <th> {{ $player->team->category->name }} </th>
                    <th> {{ $player->position }} </th>
                    <th> {{ $player->school }} </th>
                    <th> {{ $player->prepaid }}</th>
                    <th>
                      <a href="{{ url('/players/'.$player->id.'/edit') }}" class="btn btn-mini btn-warning"><i class="icon-pencil"></i></a>
                    </th>
                    <th> 
                      <form class="form-group" action="{{ '/players/'.$player->id }}" method="post">
                        {{ @csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-mini btn-danger"><i class="icon-trash"></i></button> 
                      </form>
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