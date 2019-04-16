@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/inicio') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Dashboard</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="{{ url('/teams') }}" class="tip-bottom">Equipos</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Modificar equipo</i></a></div>
    </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Modificar jugador</h5>
          </div> <!--widget-title-->
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ '/teams/'.$team->id }}">
              {{ csrf_field() }}                                                           
              {{ method_field('PUT') }}
              <div class="control-group">
                <label class="control-label">Apellidos</label>
                <div class="controls">
                  <input name="last_name" type="text" class="span11" value="{{ $team->last_name }}"  />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nombres</label>
                <div class="controls">
                  <input name="first_name" type="text" class="span11" value="{{ $player->first_name }}" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Fecha de nacimiento</label>
                <div class="controls">
                  <input name="date_birth" type="text" class="span11" value="{{ $player->birth_date->format('Y-m-d') }}"  />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Documento</label>
                <div class="controls">
                  <input name="dni" type="text" class="span11" value="{{ $player->dni }}"  />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Grupo Sanguíneo</label>
                <div class="controls">
                  <select class="span11" name="blood_id">
                    <option></option>
                      @foreach($bloodtypes as $blood)
                      <option value="{{ $blood->id }}" @if($blood->id==$player->blood_id)  selected @endif>{{ $blood->name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Institución</label>
                <div class="controls">
                  <select class="span11" name="institution_id">
                    <option></option>
                      @foreach($clubs as $club)
                      <option value="{{ $club->id }}" @if($club->id==$player->team->club_id)  selected @endif>{{ $club->name }}</option>
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