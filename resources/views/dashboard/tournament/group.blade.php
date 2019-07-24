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
            <h5>{{ $tournament->name }}</h5>
          </div> <!--widget-title-->
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{ '/tournaments/groups/'.$tournament->id.'/make' }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="quantity_teams" value="{{ $quantity_teams }}">
                <input type="hidden" name="quantity_groups" value="{{ $quantity_groups }}">
                <div class="control-group">
                  <label class="control-label">Categorías participantes</label>
                  <div class="controls">
                      <select multiple="true" class="e1 span11" name="categories[]">
                        @for($i = 0; $i < sizeof($categories); $i++)
                          <option value="{{ $categories[$i]->id }}" selected="">{{ $categories[$i]->name }}</option>
                        @endfor
                      </select>
                  </div>
                </div> 
                
                @for($i = 0; $i < $quantity_groups; $i++)
                  <div class="control-group">
                    <label class="control-label">Grupo {{ chr(65+$i) }}</label>
                    @for($j = 0; $j < ($quantity_teams/$quantity_groups) ; $j++)
                        <div id="uno" class="controls">
                          <select class="sel span11" name={{ 'teams['.$i.'][]' }}>
                            <option value="0"></option>
                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}">{{ $club->name }}</option>
                            @endforeach
                          </select>
                        </div>
                    @endfor
                  </div> 
                @endfor
                
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
  $(".sel").change(function(){cambiar();});

  function cambiar(){
    var array = [];
    $(".sel :selected").each(function(){
      array[$(this).val()]=(parseInt($(this).val()));
    });
    for(i=0;i<array.length;i++){
    if(array[i]!=undefined){
        $(".sel option[value=" + array[i] + "]").hide();
      }
      if(array[i]==undefined){
        $(".sel option[value=" + i + "]").show();
      }
    }
  }
</script>

<script>
    $(document).ready(function() {
      $('.e1').select2();
    });
</script>
@endsection