@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Panel de control</a>

      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="{{ url('/posts') }}" class="tip-bottom">Posts</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Modificar post</i></a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Modificar post</h5>
          </div> <!--widget-title-->
          <div class="widget-content nopadding">
              @if(Session::has('flash_message_error'))
                  <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
                      <strong>{!! session('flash_message_error') !!}</strong>
                  </div>
              @endif
            <form class="form-horizontal" method="post" action="{{ '/posts/'.$post->id }}">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <div class="control-group">
                <label class="control-label">Título</label>
                <div class="controls">
                  <input name="title" type="text"  class="span11" value="{{ $post->title}}" />
              </div>
              <div class="control-group">
                <label class="control-label">Cuerpo</label>
                <div class="controls">
                  <textarea name="body" type="text"  class="span11" rows="8" onkeyup="countChars(this);">{{ $post->body }}</textarea>
                  <p id="charNum">0 caracteres</p>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Foto</label>
                <div class="controls">
                  <input name="path_file" type="text"  class="span11" placeholder="URL de la imagen" value="{{ $post->path_file }}"/>
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