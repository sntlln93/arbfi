@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id='content'>
	<div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Panel de control</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Torneos</i></a></div>
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
              <span><a class="btn btn-success" href="{{ '/tournaments/create' }}"><i class="icon-plus"></i></a></span>
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
                    <th>Tipo</th>
                    <th>Imprimir fixture</th>
                    <th>Activar</th>
                    <th><i class="icon-pencil"></i></th>
                    <th><i class="icon-trash"></i></th>
                    
                </tr>
              </thead>
              <tbody>
                @foreach($tournaments as $tournament)
                  <tr>
                    <th> {{ $tournament->id }} </th>
                    <th> <a href="{{ url('tournaments/'.$tournament->id) }}">{{ $tournament->name }}</a></th>
                    <th> @if($tournament->type == "AAA") Todos contra Todos
                        @elseif($tournament->type == "GF") Fase de Grupos
                        @elseif($tournament->type == "PVP") Llaves
                        @endif | 
                        @if($tournament->round) Ida y vuelta
                        @else Partido único
                        @endif
                    </th>
                    <th>
                      <button type="button" class="btn btn-mini btn-info" data-toggle="modal" data-target="{{ '#myModal'.$tournament->id }}"><i class="icon-file"></i></button>
                    </th>
                    <th><a href="{{ url('/tournaments/'.$tournament->id.'/activate') }}" class="btn btn-mini btn-success" @if($tournament->active == 1) disabled @endif><i class="icon-trophy"></i></a></th>
                    <th>
                      <a href="{{ url('/tournaments/'.$tournament->id.'/edit') }}" class="btn btn-mini btn-warning"><i class="icon-pencil"></i></a>
                    </th>
                    <th> 
                      <form class="form-group" action="{{ url('/tournaments/'.$tournament->id) }}" method="post">
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
<!--modal-->
@foreach($tournaments as $tournament)
  <div id="{{ 'myModal'.$tournament->id }}" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Elija la fecha a imprimir</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="get" action="{{ '/tournaments/'.$tournament->id.'/pdf' }}">
            {{ csrf_field() }}
            <div class="control-group">
              <label class="control-label">Fecha</label>
              <div class="controls">
                  <input name="fixture_day" type="number" min="1">
              </div>
            </div> 
            
            
              <div class="form-actions">
                  <button type="btn btn-success" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Imprimir</button>
              </div>
            
            
        </form>
        </div>
      </div>

    </div>
  </div>
@endforeach
  


<script>
    $(function () {
    $('input#filtrar').quicksearch('table tbody tr');               
    });
</script>

@endsection