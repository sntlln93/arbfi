@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id='content'>
	<div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Panel de control</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Equipos</i></a></div>
    </div>
    
    <div class="container-fluid">
      <div class="pull-right">
        <div class="controls">
          <br>
          <div class="input-append">
              <input id="filtrar" name="search" value="" type="text" placeholder="Buscar" class="span3">
              <span class="add-on"><i class="icon-search"></i></span>
          </div>
        </div>
      </div>

      <div class="widget-box">
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table"><!--table-responsive-lg-->
              <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th><i class="icon-files"></i>Imprimir carnets</th>
                </tr>
              </thead>
              <tbody>
                @foreach($teams as $team)
                  <tr>
                    <th> {{ $team->id }} </th>
                    <th> {{ $team->club->name }}</th>
                    <th> {{ $team->category->name }} </th>
                    <th> 
                        <a href="{{ url('/teams/'.$team->id.'/pdf') }}" class="btn btn-mini btn-info"><i class="icon-file"></i></a>
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