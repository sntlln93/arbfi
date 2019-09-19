@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Panel de control</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="{{ url('/players') }}" class="tip-bottom">Jugadores</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Modificar jugador</i></a></div>
    </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Modificar jugador</h5>
          </div> <!--widget-title-->
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ '/players/'.$player->id }}" enctype="multipart/form-data">
              {{ csrf_field() }}                                                           
              {{ method_field('PUT') }}
              <div class="control-group">
                <label class="control-label">Apellidos</label>
                <div class="controls">
                  <input name="last_name" type="text" class="span11" value="{{ $player->last_name }}"  />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Nombres</label>
                <div class="controls">
                  <input name="first_name" type="text" class="span11" value="{{ $player->first_name }}" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Categoría</label>
                <div class="controls">
                  <select class="span11" name="category_name" disabled="">
                    <option></option>
                    <option value="{{ $player->team->category->name }}" selected="">{{ $player->team->category->name }}</option>
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Fecha de nacimiento</label>
                <div class="controls">
                  <input name="date_birth" type="date" class="span11" min="2005-01-01" max="2019-01-01" value="{{ $player->birth_date->format('Y-m-d') }}"  />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Documento</label>
                <div class="controls">
                  <input name="dni" type="text" class="span11" value="{{ $player->dni }}"  />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Institución</label>
                <div class="controls">
                  <select disabled ="" class="span11" name="institution_id">
                    <option></option>
                      <option value="{{ $player->team->club->id }}" selected>{{ $player->team->club->name }}</option>
                  </select>
                </div>
              </div>
              

              <div class="control-group">
                <label class="control-label">Posición</label>
                <div class="controls">
                  <input name="position" type="text"  class="span11" value="{{ $player->position }}" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Colegio</label>
                <div class="controls">
                  <input name="school" type="text"  class="span11" value="{{ $player->school }}" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Obra Social</label>
                <div class="controls">
                  <input name="prepaid" type="text"  class="span11" value="{{ $player->prepaid }}" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Foto</label>
                <div class="controls">
                    @if($player->image_id)
                      <img class="editimage" src="{{ asset('storage/'.$player->image->path) }}" alt="">
                    @endif
                    <div class="custom-file">
                        <input name="image" type="file" class="custom-file-input" id="validatedCustomFile">
                    </div>
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