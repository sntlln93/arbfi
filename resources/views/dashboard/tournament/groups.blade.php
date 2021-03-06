@extends('layouts.dash_layout.dashboard_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
      <a href="{{ url('/dashboard') }}" title="Ir a inicio" class="tip-bottom"><i class="icon-home"></i> Panel de control</a>

      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="{{ url('/tournaments') }}" class="tip-bottom">Zonas</a>
      <a class="breadcrumb-item"><i class="icon-arrow-right"></i></a>
      <a href="#" class="current">Nuevo torneo por zonas</i></a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Nuevo torneo por fase de grupos</h5>
          </div> <!--widget-title-->
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ '/tournaments/groups/'.$tournament->id }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
              <div class="control-group">
                <label class="control-label">Nombre</label>
                <div class="controls">
                  <input name="name" type="text" disabled="" class="span11" value="{{ $tournament->name }}" />
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">Categorías participantes</label>
                <div class="controls">
                  <select multiple="true" class="e1 span11" name="categories[]">
                    @foreach($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>


              <div class="control-group">
                <label class="control-label">Cantidad de grupos</label>
                <div class="controls">
                  <input name="quantity_groups" type="number"  class="span11" min="2" />
                </div>
              </div> 

              <div class="control-group">
                <label class="control-label">Cantidad de equipos</label>
                <div class="controls">
                  <input name="quantity_teams" type="number"  class="span11" min="6" />
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
    $(document).ready(function() {
      $('.e1').select2();
    });
</script>
@endsection