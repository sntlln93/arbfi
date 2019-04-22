@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id='content'>
	<div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/inicio') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Tipos de torneos</i></a></div>
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
                    <th>Tipo</th>
                </tr>
              </thead>
              <tbody>
                @foreach($types as $type)
                  <tr>
                    <th> {{ $type->id }} </th>
                    <th> 
                        @if($type->type == "AAA") Todos contra Todos
                        @elseif($type->type == "GF") Fase de Grupos
                        @elseif($type->type == "PVP") Llaves
                        @endif | 
                        @if($type->round_trip) Ida y vuelta
                        @else Partido único
                        @endif
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