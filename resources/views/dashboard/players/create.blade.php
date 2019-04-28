@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Inicio</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="{{ url('/players') }}" class="tip-bottom">Jugadores</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Nuevo jugador</i></a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Nuevo Jugador</h5>
          </div> <!--widget-title-->
          <div class="widget-content nopadding">
              @if(Session::has('flash_message_error'))
              <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                  <strong>{!! session('flash_message_error') !!}</strong>
              </div>
          @endif
            <form class="form-horizontal" method="post" action="{{ '/players' }}">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Apellidos</label>
                <div class="controls">
                  <input name="last_name" type="text"  class="span11" placeholder="Apellidos" />
              </div>
              <div class="control-group">
                <label class="control-label">Nombres</label>
                <div class="controls">
                  <input name="first_name" type="text"  class="span11" placeholder="Nombres" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Categoría</label>
                <div class="controls">
                  <select class="span11" name="category_name">
                    <option></option>
                    @foreach($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Fecha de nacimiento</label>
                <div class="controls">
                  <input name="date_birth" type="text"  class="span11" placeholder="AAAA-MM-DD ej: 2005-05-24" />
                </div>
              </div>  

              <div class="control-group">
                <label class="control-label">Documento</label>
                <div class="controls">
                  <input name="dni" type="text"  class="span11" placeholder="Número de documento SIN PUNTOS" />
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Institución</label>
                <div class="controls">
                  <select class="span11" name="institution_id">
                    <option></option>
                    @foreach($clubs as $club)
                    <option value="{{ $club->id }}">{{ $club->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Posición</label>
                <div class="controls">
                  <input name="position" type="text"  class="span11" placeholder="Posición dentro del campo de juego" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Obra Social</label>
                <div class="controls">
                  <input name="prepaid" type="text"  class="span11" placeholder="Obra Social del jugador" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Colegio</label>
                <div class="controls">
                  <input name="school" type="text"  class="span11" placeholder="Colegio/escuela" />
                </div>
              </div>

              <div class="control-group">
                <label class="control-label">Foto</label>
                <div class="controls">
                  <input name="path_file" type="text"  class="span11" placeholder="URL de la imagen" />
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