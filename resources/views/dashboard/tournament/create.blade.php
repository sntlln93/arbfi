@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Panel de control</a>

      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="{{ url('/tournaments') }}" class="tip-bottom">Torneos</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Nuevo torneo</i></a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Nuevo torneo</h5>
          </div> <!--widget-title-->
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ '/tournaments' }}">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Nombre</label>
                <div class="controls">
                  <input name="name" type="text"  class="span11" placeholder="Nombre" />
              </div>
              
              <div class="control-group">
                <label class="control-label">Tipos</label>
                <div class="controls">
                  <select class="span11" name="type_id">
                    <option></option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">
                          @if($type->type == "AAA") Todos contra Todos
                          @elseif($type->type == "GF") Fase de Grupos
                          @elseif($type->type == "PVP") Llaves
                          @elseif($type->type == "SC") Super Copa
                          @endif | 
                          @if($type->round_trip) Ida y vuelta
                          @else Partido único
                          @endif
                        </option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-actions">
                <button type="submit" class="btn btn-success">Guardar</button>
              </div>
            </form>

          </div> <!--widget-content nopadding-->
        </div> <!--widget-box-->
        @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
      </div> <!--span6-->
    </div><!--row-fluid-->
  </div> <!--container-fluid-->
</div> <!--content-->

@endsection