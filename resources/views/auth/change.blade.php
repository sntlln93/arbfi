@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/inicio') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Inicio</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Cambiar contraseña</i></a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-key"></i> </span>
            <h5>Cambiar contraseña</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ '/users/'.Auth::user()->id }}">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="control-group">
                <label class="control-label">Contraseña</label>
                <div class="controls">
                  <input name="password" type="password"  class="span11"/>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Confirme su contraseña</label>
                <div class="controls">
                  <input name="password_confirmation" type="password"  class="span11"/>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-success">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @if($errors->any())
      <div class="alert alert-danger">
          @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
          @endforeach
      </div>
    @endif
  </div> <!--container-fluid-->
</div> <!--content-->

@endsection