@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Panel de control</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="{{ url('/regulation') }}" class="tip-bottom">Capítulos</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Nuevo artículo</i></a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Nuevo artículo</h5>
          </div> <!--widget-title-->
          <div class="widget-content nopadding">
              @if(Session::has('flash_message_error'))
                  <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                      <strong>{!! session('flash_message_error') !!}</strong>
                  </div>
              @endif
            <form class="form-horizontal" method="post" action="{{ '/articles' }}">
              {{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Número</label>
                <div class="controls">
                  <input name="name" type="number"  class="span11" placeholder="Número del capítulo" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Capítulo</label>
                <div class="controls">
                  <select class="span11" name="chapter_id">
                    <option></option>
                    @foreach($chapters as $chapter)
                    <option value="{{ $chapter->id }}">{{ $chapter->id.' - '.$chapter->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
                <div class="control-group">
                    <label class="control-label">Cuerpo</label>
                    <div class="controls">
                      <textarea name="body" type="text"  class="span11" rows="4" onkeyup="countChars(this);"></textarea>
                      <p id="charNum">0 caracteres</p>
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

<script>
  function countChars(obj){
    document.getElementById("charNum").innerHTML = obj.value.length+' caracteres';
  }
</script>
@endsection