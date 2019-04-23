@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Inicio</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="{{ url('/institutions') }}" class="tip-bottom">Instituciones</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Nueva institución</i></a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Nuevo institución</h5>
          </div> <!--widget-title-->
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ '/institutions' }}">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Nombre</label>
                <div class="controls">
                  <input name="name" type="text"  class="span11" placeholder="Nombre" />
              </div>
              <div class="control-group">
                <label class="control-label">Responsable</label>
                <div class="controls">
                  <input name="responsable" type="text"  class="span11" placeholder="Responsable" />
              </div>
              <div class="control-group">
                <label class="control-label">Cancha</label>
                <div class="controls">
                  <input name="stadium" type="text"  class="span11" placeholder="Cancha" />
              </div>
              <div class="control-group">
                <label class="control-label">Escudo</label>
                <div class="controls">
                  <input name="path_file" type="text"  class="span11" placeholder="Cancha" />
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